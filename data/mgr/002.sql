CREATE TABLE website (id BIGINT AUTO_INCREMENT, namespace VARCHAR(255), url VARCHAR(255), is_secure TINYINT(1) DEFAULT '1', PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE website_project (id BIGINT AUTO_INCREMENT, website_id BIGINT NOT NULL, name VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX website_id_idx (website_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE website_project2sf_guard_user (website_project_id BIGINT, sf_guard_user_id BIGINT, PRIMARY KEY(website_project_id, sf_guard_user_id)) ENGINE = INNODB;

ALTER TABLE website_project ADD COLUMN codebase_type VARCHAR(255) DEFAULT 'input' AFTER name;
ALTER TABLE website_project ADD COLUMN  codebase_file VARCHAR(255) AFTER codebase_type;
ALTER TABLE website_project ADD COLUMN   codebase_input TEXT AFTER codebase_file;