Typical usage from TypoScript:

config.tx_ja_replacer {
	search {
		1="typo3temp/pics/
		2="fileadmin/
	}
	replace {
		1="http://mycdn.com/i/
		2="http://mycdn.com/f/
	}
}

Don't forget to clear the cache afterwards.
