-- ff-sicking.at (TYPO3 7.6)
CREATE DATABASE IF NOT EXISTS `typo3_ffsicking` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER IF NOT EXISTS 'typo3_ffsicking'@'%' IDENTIFIED BY 'ffsicking-db-pass-2026';
GRANT ALL PRIVILEGES ON `typo3_ffsicking`.* TO 'typo3_ffsicking'@'%';

-- physiotherapie-huber.at (TYPO3 4.5)
CREATE DATABASE IF NOT EXISTS `typo3_physiotherapiehuber` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER IF NOT EXISTS 'typo3_physio'@'%' IDENTIFIED BY 'physio-db-pass-2026';
GRANT ALL PRIVILEGES ON `typo3_physiotherapiehuber`.* TO 'typo3_physio'@'%';

-- hittmayr.at (TYPO3 7.x)
CREATE DATABASE IF NOT EXISTS `typo3_hittmayr` CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER IF NOT EXISTS 'typo3_hittmayr'@'%' IDENTIFIED BY 'hittmayr-db-pass-2026';
GRANT ALL PRIVILEGES ON `typo3_hittmayr`.* TO 'typo3_hittmayr'@'%';

FLUSH PRIVILEGES;