
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- employee
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee`
(
    `emp_id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30) NOT NULL,
    `emp_ssn` INTEGER NOT NULL,
    `phone_num` VARCHAR(20) NOT NULL,
    `salary` INTEGER NOT NULL,
    `job_title` VARCHAR(20) NOT NULL,
    PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- finances
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `finances`;

CREATE TABLE `finances`
(
    `invoices` VARCHAR(11) NOT NULL,
    `bills` VARCHAR(11) NOT NULL,
    `payroll` INTEGER NOT NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- inventory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory`
(
    `item` INTEGER NOT NULL AUTO_INCREMENT,
    `ship_date` DATE NOT NULL,
    `supplier` VARCHAR(11) NOT NULL,
    `in_stock` INTEGER NOT NULL,
    PRIMARY KEY (`item`)
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
    `name` VARCHAR(11) NOT NULL,
    `address` VARCHAR(30) NOT NULL,
    `phone_num` INTEGER NOT NULL,
    PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
