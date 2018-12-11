
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- employee
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `emp_ssn` INTEGER(20) NOT NULL,
    `name` VARCHAR(20) NOT NULL,
    `phone_num` VARCHAR(20) NOT NULL,
    `salary` INTEGER NOT NULL,
    `job_title` VARCHAR(20) NOT NULL,
    `hired_by` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `paid_by` (`hired_by`),
    CONSTRAINT `employee_ibfk_1`
        FOREIGN KEY (`hired_by`)
        REFERENCES `owner` (`owner_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- finances
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `finances`;

CREATE TABLE `finances`
(
    `invoices` INTEGER NOT NULL,
    `bills` INTEGER NOT NULL,
    `paid_by` INTEGER NOT NULL,
    `payroll` INTEGER NOT NULL,
    `due_on` DATE NOT NULL,
    INDEX `paid_by` (`paid_by`),
    CONSTRAINT `finances_ibfk_1`
        FOREIGN KEY (`paid_by`)
        REFERENCES `owner` (`owner_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- inventory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory`
(
    `item_id` INTEGER NOT NULL AUTO_INCREMENT,
    `item_name` VARCHAR(20) NOT NULL,
    `supplied_by` INTEGER NOT NULL,
    `ship_date` DATE NOT NULL,
    `in_stock` INTEGER NOT NULL,
    `done_by` INTEGER NOT NULL,
    PRIMARY KEY (`item_id`),
    INDEX `supplier` (`supplied_by`),
    INDEX `done_by` (`done_by`),
    CONSTRAINT `inventory_ibfk_1`
        FOREIGN KEY (`supplied_by`)
        REFERENCES `supplier` (`sup_id`),
    CONSTRAINT `inventory_ibfk_2`
        FOREIGN KEY (`done_by`)
        REFERENCES `owner` (`owner_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- owner
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `owner`;

CREATE TABLE `owner`
(
    `owner_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(20) NOT NULL,
    `address` VARCHAR(30) NOT NULL,
    `phone_num` VARCHAR(20) NOT NULL,
    `password_hash` VARCHAR(128) NOT NULL,
    PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- supplier
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier`
(
    `sup_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(20) NOT NULL,
    `address` VARCHAR(30) NOT NULL,
    `phone_num` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
