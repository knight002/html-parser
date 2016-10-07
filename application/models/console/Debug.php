<?php

/**
 * Debug methods
 */
class Application_Model_Console_Debug
{
	# Reset
	const TEXT_Color_Off = "\033[0m";       # Text Reset

	# Regular Colors
	const TEXT_Black = "\033[0;30m";        # Black
	const TEXT_Red = "\033[0;31m";          # Red
	const TEXT_Green = "\033[0;32m";        # Green
	const TEXT_Yellow = "\033[0;33m";       # Yellow
	const TEXT_Blue = "\033[0;34m";         # Blue
	const TEXT_Purple = "\033[0;35m";       # Purple
	const TEXT_Cyan = "\033[0;36m";         # Cyan
	const TEXT_White = "\033[0;37m";        # White

	# Bold
	const TEXT_BBlack = "\033[1;30m";       # Black
	const TEXT_BRed = "\033[1;31m";         # Red
	const TEXT_BGreen = "\033[1;32m";       # Green
	const TEXT_BYellow = "\033[1;33m";      # Yellow
	const TEXT_BBlue = "\033[1;34m";        # Blue
	const TEXT_BPurple = "\033[1;35m";      # Purple
	const TEXT_BCyan = "\033[1;36m";        # Cyan
	const TEXT_BWhite = "\033[1;37m";       # White

	# Underline
	const TEXT_UBlack = "\033[4;30m";       # Black
	const TEXT_URed = "\033[4;31m";         # Red
	const TEXT_UGreen = "\033[4;32m";       # Green
	const TEXT_UYellow = "\033[4;33m";      # Yellow
	const TEXT_UBlue = "\033[4;34m";        # Blue
	const TEXT_UPurple = "\033[4;35m";      # Purple
	const TEXT_UCyan = "\033[4;36m";        # Cyan
	const TEXT_UWhite = "\033[4;37m";       # White

	# Background
	const TEXT_On_Black = "\033[40m";       # Black
	const TEXT_On_Red = "\033[41m";         # Red

	/**
	 * Prints out a string
	 * @param String $str String to echo
	 * @param String $color Color of the text
	 */
	public static function printout($str, $color)
	{
		print_r($color);
		echo "$str\n";
		print_r(self::TEXT_Color_Off);
	}
}
