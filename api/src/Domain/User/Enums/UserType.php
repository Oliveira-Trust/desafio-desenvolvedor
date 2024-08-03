<?php

namespace Domain\User\Enums;

enum UserType: string
{
	case Regular = 'regular';

	case Admin = 'admin';
}