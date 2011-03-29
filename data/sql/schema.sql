CREATE TABLE action_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE action (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, author VARCHAR(150) NOT NULL, action_date DATE, location VARCHAR(255), min_users_allowed BIGINT NOT NULL, max_users_allowed BIGINT, register_start_date DATE NOT NULL, register_end_date DATE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX action_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE action_has_category (category_id BIGINT UNIQUE, action_id BIGINT UNIQUE, slug VARCHAR(255), UNIQUE INDEX action_has_category_sluggable_idx (slug), PRIMARY KEY(category_id, action_id)) ENGINE = INNODB;
CREATE TABLE action_has_user (action_id BIGINT UNIQUE, user_id BIGINT UNIQUE, slug VARCHAR(255), UNIQUE INDEX action_has_user_sluggable_idx (slug), PRIMARY KEY(action_id, user_id)) ENGINE = INNODB;
CREATE TABLE category (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, description VARCHAR(255), slug VARCHAR(255), UNIQUE INDEX category_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE citizen_action_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE citizen_action (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, author VARCHAR(150) NOT NULL, action_date DATE, location VARCHAR(255), min_users_allowed BIGINT NOT NULL, max_users_allowed BIGINT, register_start_date DATE NOT NULL, register_end_date DATE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX citizen_action_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE citizen_proposal_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE citizen_proposal (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, tip LONGTEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX citizen_proposal_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE content_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE content (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX content_sluggable_idx (slug, title), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE content_has_category (content_id BIGINT UNIQUE, category_id BIGINT UNIQUE, slug VARCHAR(255), UNIQUE INDEX content_has_category_sluggable_idx (slug), PRIMARY KEY(content_id, category_id)) ENGINE = INNODB;
CREATE TABLE content_has_region (content_id BIGINT, region_id BIGINT, slug VARCHAR(255), UNIQUE INDEX content_has_region_sluggable_idx (slug), PRIMARY KEY(content_id, region_id)) ENGINE = INNODB;
CREATE TABLE goverment_consultation_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE goverment_consultation (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, start_date DATE NOT NULL, end_date DATE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX goverment_consultation_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE goverment_new_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE goverment_new (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, publish_date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX goverment_new_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE goverment_proposal_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE goverment_proposal (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, publish_date DATE NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX goverment_proposal_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE proposal_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE proposal (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX proposal_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE region (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, description VARCHAR(255), root_id BIGINT, lft INT, rgt INT, level SMALLINT, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE response (id BIGINT AUTO_INCREMENT, body LONGTEXT NOT NULL, initiative_id BIGINT, slug VARCHAR(255), UNIQUE INDEX response_sluggable_idx (slug), INDEX initiative_id_idx (initiative_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE subscription_category (user_id BIGINT UNIQUE, category_id BIGINT UNIQUE, slug VARCHAR(255), UNIQUE INDEX subscription_category_sluggable_idx (slug), PRIMARY KEY(user_id, category_id)) ENGINE = INNODB;
CREATE TABLE subscription_region (user_id BIGINT UNIQUE, region_id BIGINT UNIQUE, slug VARCHAR(255), UNIQUE INDEX subscription_region_sluggable_idx (slug), PRIMARY KEY(user_id, region_id)) ENGINE = INNODB;
CREATE TABLE virtual_meeting (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, user_id BIGINT NOT NULL, answers_start_date DATE NOT NULL, answers_end_date DATE NOT NULL, slug VARCHAR(255), UNIQUE INDEX virtual_meeting_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE virtual_meeting_answer (id BIGINT AUTO_INCREMENT, answer LONGTEXT NOT NULL, opinion_id BIGINT NOT NULL, user_id BIGINT NOT NULL, slug VARCHAR(255), UNIQUE INDEX virtual_meeting_answer_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE workshop_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE workshop (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, image VARCHAR(255), video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, user_id BIGINT NOT NULL, author VARCHAR(150) NOT NULL, action_date DATE, location VARCHAR(255), min_users_allowed BIGINT NOT NULL, max_users_allowed BIGINT, register_start_date DATE NOT NULL, register_end_date DATE, price DECIMAL(18, 2) DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), UNIQUE INDEX workshop_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_profile (user_id BIGINT UNIQUE, nickname VARCHAR(255), gender BIGINT, telephone VARCHAR(25), address VARCHAR(255), postal_code VARCHAR(10), location VARCHAR(150), province VARCHAR(150), country VARCHAR(150), web VARCHAR(255), about LONGTEXT, subscription_email TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), PRIMARY KEY(user_id)) ENGINE = INNODB;
ALTER TABLE action_index ADD CONSTRAINT action_index_id_action_id FOREIGN KEY (id) REFERENCES action(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE action ADD CONSTRAINT action_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE action_has_category ADD CONSTRAINT action_has_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE;
ALTER TABLE action_has_user ADD CONSTRAINT action_has_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE action_has_user ADD CONSTRAINT action_has_user_action_id_action_id FOREIGN KEY (action_id) REFERENCES action(id);
ALTER TABLE citizen_action_index ADD CONSTRAINT citizen_action_index_id_citizen_action_id FOREIGN KEY (id) REFERENCES citizen_action(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE citizen_action ADD CONSTRAINT citizen_action_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE citizen_proposal_index ADD CONSTRAINT citizen_proposal_index_id_citizen_proposal_id FOREIGN KEY (id) REFERENCES citizen_proposal(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE citizen_proposal ADD CONSTRAINT citizen_proposal_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE content_index ADD CONSTRAINT content_index_id_content_id FOREIGN KEY (id) REFERENCES content(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE content ADD CONSTRAINT content_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE content_has_category ADD CONSTRAINT content_has_category_content_id_content_id FOREIGN KEY (content_id) REFERENCES content(id) ON DELETE CASCADE;
ALTER TABLE content_has_category ADD CONSTRAINT content_has_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE;
ALTER TABLE content_has_region ADD CONSTRAINT content_has_region_region_id_region_id FOREIGN KEY (region_id) REFERENCES region(id) ON DELETE CASCADE;
ALTER TABLE content_has_region ADD CONSTRAINT content_has_region_content_id_content_id FOREIGN KEY (content_id) REFERENCES content(id) ON DELETE CASCADE;
ALTER TABLE goverment_consultation_index ADD CONSTRAINT goverment_consultation_index_id_goverment_consultation_id FOREIGN KEY (id) REFERENCES goverment_consultation(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE goverment_consultation ADD CONSTRAINT goverment_consultation_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE goverment_new_index ADD CONSTRAINT goverment_new_index_id_goverment_new_id FOREIGN KEY (id) REFERENCES goverment_new(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE goverment_new ADD CONSTRAINT goverment_new_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE goverment_proposal_index ADD CONSTRAINT goverment_proposal_index_id_goverment_proposal_id FOREIGN KEY (id) REFERENCES goverment_proposal(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE goverment_proposal ADD CONSTRAINT goverment_proposal_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE proposal_index ADD CONSTRAINT proposal_index_id_proposal_id FOREIGN KEY (id) REFERENCES proposal(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE proposal ADD CONSTRAINT proposal_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE response ADD CONSTRAINT response_initiative_id_content_id FOREIGN KEY (initiative_id) REFERENCES content(id) ON DELETE CASCADE;
ALTER TABLE subscription_category ADD CONSTRAINT subscription_category_user_id_sf_guard_user_profile_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user_profile(user_id) ON DELETE CASCADE;
ALTER TABLE subscription_category ADD CONSTRAINT subscription_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE;
ALTER TABLE subscription_region ADD CONSTRAINT subscription_region_user_id_sf_guard_user_profile_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user_profile(user_id) ON DELETE CASCADE;
ALTER TABLE subscription_region ADD CONSTRAINT subscription_region_region_id_region_id FOREIGN KEY (region_id) REFERENCES region(id) ON DELETE CASCADE;
ALTER TABLE virtual_meeting ADD CONSTRAINT virtual_meeting_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE virtual_meeting_answer ADD CONSTRAINT virtual_meeting_answer_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE workshop_index ADD CONSTRAINT workshop_index_id_workshop_id FOREIGN KEY (id) REFERENCES workshop(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE workshop ADD CONSTRAINT workshop_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
