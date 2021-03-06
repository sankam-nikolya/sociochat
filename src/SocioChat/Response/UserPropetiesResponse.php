<?php

namespace SocioChat\Response;

use SocioChat\Clients\User;
use SocioChat\DI;
use SocioChat\Enum\SexEnum;
use SocioChat\Enum\TimEnum;

class UserPropetiesResponse extends Response
{
    protected $id;
    protected $name;
    protected $about;
    protected $email;
    protected $tim = TimEnum::FIRST;
    protected $sex = SexEnum::FIRST;
    protected $msg;
    protected $avatarImg;
    protected $avatarThumb;
    protected $city;
    protected $birth;
    protected $censor;
	protected $notifyVisual;
	protected $notifySound;
	protected $lineBreakType;
	protected $onlineNotifyLimit;
    protected $isSubscribed;
    protected $msgAnimationType;

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setAbout($about)
    {
        $this->about = $about;
        return $this;
    }

    public function setTim($tim)
    {
        $this->tim = $tim;
        return $this;
    }

    public function setSex($sex)
    {
        $this->sex = $sex;
        return $this;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setAvatarImg($avatar)
    {
        $this->avatarImg = $avatar;
        return $this;
    }

    public function setAvatarThumb($avatarThumb)
    {
        $this->avatarThumb = $avatarThumb;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getYear()
    {
        return $this->birth;
    }

    public function setYear($year)
    {
        $this->birth = $year;
        return $this;
    }

    public function getCensor()
    {
        return $this->censor;
    }

    public function setCensor($hasCense)
    {
        $this->censor = $hasCense;
        return $this;
    }

	public function setNotifyVisual($checkbox)
	{
		$this->notifyVisual = $checkbox;
		return $this;
	}
	public function setNotifySound($checkbox)
	{
		$this->notifySound = $checkbox;
		return $this;
	}

	public function setLineBreakType($checkbox)
	{
		$this->lineBreakType = $checkbox;
		return $this;
	}

	public function setOnlineNotifyLimit($limit)
	{
		$this->onlineNotifyLimit = $limit;
		return $this;
	}

	private function setSubscription($hasSubscription)
	{
		$this->isSubscribed = $hasSubscription;
		return $this;
	}

    public function setMsgAnimationType($type)
    {
        $this->msgAnimationType = $type;
        return $this;
    }

    public function setUserProps(User $user)
    {
        $properties = $user->getProperties();
        $dir = DI::get()->getConfig()->uploads->avatars->wwwfolder . '/';

        $this
            ->setId($user->getId())
            ->setEmail($user->getUserDAO()->getEmail())
            ->setSex($properties->getSex()->getId())
            ->setTim($properties->getTim()->getId())
            ->setName($properties->getName())
            ->setAbout($properties->getAbout())
            ->setAvatarImg($properties->getAvatarImg() ? $dir . $properties->getAvatarImg() : null)
            ->setAvatarThumb($properties->getAvatarThumb() ? $dir . $properties->getAvatarThumb() : null)
            ->setYear($properties->getBirthday())
            ->setCity($properties->getCity())
            ->setCensor($properties->hasCensor())
	        ->setNotifyVisual($properties->hasNotifyVisual())
            ->setNotifySound($properties->hasNotifySound())
            ->setLineBreakType($properties->getLineBreakType())
            ->setOnlineNotifyLimit($properties->getOnlineNotificationLimit())
	        ->setSubscription($properties->hasSubscription())
            ->setMsgAnimationType($properties->getMessageAnimationType())
        ;

        return $this;
    }

    public function toString()
    {
        $json = parent::toString();

        return '{"ownProperties" : ' . $json . '}';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
} 