<?php
namespace NeosRulez\Neos\Form\AltchaCaptcha\Domain\Service;

use Neos\Flow\Annotations as Flow;
use AltchaOrg\Altcha\ChallengeOptions;
use AltchaOrg\Altcha\Altcha;
use AltchaOrg\Altcha\Hasher\Algorithm;

class AltchaService
{

    #[Flow\InjectConfiguration(path: 'security.minNumber', package: 'NeosRulez.Neos.Form.AltchaCaptcha')]
    protected int $minNumber;

    #[Flow\InjectConfiguration(path: 'security.maxNumber', package: 'NeosRulez.Neos.Form.AltchaCaptcha')]
    protected int $maxNumber;

    #[Flow\InjectConfiguration(path: 'security.hmac', package: 'NeosRulez.Neos.Form.AltchaCaptcha')]
    protected string $hmac;

    #[Flow\InjectConfiguration(path: 'security.expires', package: 'NeosRulez.Neos.Form.AltchaCaptcha')]
    protected int $expires;

    /**
     * @return array
     */
    public function createChallenge(): array
    {
        $altcha = new Altcha($this->hmac);
        $options = new ChallengeOptions(
            Algorithm::SHA256,
            $this->maxNumber,
            (new \DateTimeImmutable())->add(new \DateInterval('PT' . $this->expires . 'S'))
        );
        $challenge = $altcha->createChallenge($options);

        return [
            'algorithm' => $challenge->algorithm,
            'challenge' => $challenge->challenge,
            'number'    => random_int($this->minNumber, $this->maxNumber),
            'salt'      => $challenge->salt,
            'signature' => $challenge->signature,
        ];
    }

    /**
     * @param string $payload
     * @return bool
     */
    public function validate(string $payload): bool
    {
        $altcha = new Altcha($this->hmac);
        if($altcha->verifySolution($payload)) {
            return true;
        }
        return false;
    }

}