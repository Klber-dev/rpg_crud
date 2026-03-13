	CREATE TABLE `aventureiros` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_uca1400_ai_ci',
	`classe_id` INT(11) NOT NULL DEFAULT '1',
	`exp` INT(11) NULL DEFAULT '0',
	`status` ENUM('Y','N') NULL DEFAULT 'Y' COLLATE 'utf8mb4_uca1400_ai_ci',
	`data_criacao` TIMESTAMP NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `UNIQUE` (`nome`) USING BTREE
)
COMMENT='\r\n'
COLLATE='utf8mb4_uca1400_ai_ci'
ENGINE=InnoDB
;
