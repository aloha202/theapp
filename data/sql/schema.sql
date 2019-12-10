CREATE TABLE default_image (id BIGINT AUTO_INCREMENT, name VARCHAR(255), title VARCHAR(255), image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE text_block_translation (id BIGINT, text TEXT, lang CHAR(2), PRIMARY KEY(id, lang)) ENGINE = INNODB;
CREATE TABLE text_block (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, title VARCHAR(255), application VARCHAR(32), module VARCHAR(32), special_mark VARCHAR(32), is_visible_for_admin TINYINT(1) DEFAULT '0', INDEX section_index_idx (application, module), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE user_settings (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, show_on_all_websites TINYINT(1) DEFAULT '1', INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE webapp_config (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, website_project_id BIGINT NOT NULL, config TEXT, is_active TINYINT(1) DEFAULT '1', INDEX user_id_idx (user_id), INDEX website_project_id_idx (website_project_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE website (id BIGINT AUTO_INCREMENT, namespace VARCHAR(255), host VARCHAR(255), is_secure TINYINT(1) DEFAULT '1', PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE website_project (id BIGINT AUTO_INCREMENT, website_id BIGINT, name VARCHAR(255), codebase_type VARCHAR(255) DEFAULT 'input', codebase_file VARCHAR(255), codebase_input TEXT, has_window TINYINT(1) DEFAULT '1', is_free TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX website_id_idx (website_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE website_project2sf_guard_user (website_project_id BIGINT, sf_guard_user_id BIGINT, PRIMARY KEY(website_project_id, sf_guard_user_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, lang VARCHAR(255) DEFAULT 'en', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE text_block_translation ADD CONSTRAINT text_block_translation_id_text_block_id FOREIGN KEY (id) REFERENCES text_block(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE user_settings ADD CONSTRAINT user_settings_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE webapp_config ADD CONSTRAINT webapp_config_website_project_id_website_project_id FOREIGN KEY (website_project_id) REFERENCES website_project(id) ON DELETE CASCADE;
ALTER TABLE webapp_config ADD CONSTRAINT webapp_config_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE website_project ADD CONSTRAINT website_project_website_id_website_id FOREIGN KEY (website_id) REFERENCES website(id) ON DELETE CASCADE;
ALTER TABLE website_project2sf_guard_user ADD CONSTRAINT wwwi FOREIGN KEY (website_project_id) REFERENCES website_project(id) ON DELETE CASCADE;
ALTER TABLE website_project2sf_guard_user ADD CONSTRAINT website_project2sf_guard_user_sf_guard_user_id_sf_guard_user_id FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
