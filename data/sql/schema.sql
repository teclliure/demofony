CREATE TABLE action (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, author VARCHAR(150) NOT NULL, action_date DATE, location VARCHAR(255), min_users_allowed BIGINT NOT NULL, max_users_allowed BIGINT, register_start_date DATE NOT NULL, register_end_date DATE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX action_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE action_has_category (category_id BIGINT UNIQUE, action_id BIGINT UNIQUE, slug VARCHAR(255), UNIQUE INDEX action_has_category_sluggable_idx (slug), PRIMARY KEY(category_id, action_id)) ENGINE = INNODB;
CREATE TABLE action_has_user (action_id BIGINT, user_id BIGINT, type VARCHAR(100), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX IX_ActionHasUser_1_idx (action_id, user_id), PRIMARY KEY(action_id, user_id, type)) ENGINE = INNODB;
CREATE TABLE category (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, description VARCHAR(255), slug VARCHAR(255), UNIQUE INDEX category_sluggable_idx (slug), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE citizen_action (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, author VARCHAR(150) NOT NULL, action_date DATE, location VARCHAR(255), min_users_allowed BIGINT NOT NULL, max_users_allowed BIGINT, register_start_date DATE NOT NULL, register_end_date DATE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX citizen_action_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE citizen_proposal (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, tip LONGTEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX citizen_proposal_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE comment (id BIGINT AUTO_INCREMENT, record_model VARCHAR(255) NOT NULL, record_id BIGINT NOT NULL, author_name VARCHAR(255) NOT NULL, author_email VARCHAR(255), author_website VARCHAR(255), body LONGTEXT NOT NULL, is_delete TINYINT(1) DEFAULT '0', edition_reason LONGTEXT, reply BIGINT, user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX record_model_record_id_idx (record_model, record_id), INDEX reply_idx (reply), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE comment_report (id BIGINT AUTO_INCREMENT, reason LONGTEXT NOT NULL, referer VARCHAR(255), state VARCHAR(255) DEFAULT 'untreated', id_comment BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX id_comment_idx (id_comment), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE content (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX content_sluggable_idx (slug, title), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE content_has_category (content_id BIGINT, category_id BIGINT, type VARCHAR(100), slug VARCHAR(255), UNIQUE INDEX IX_ContentHasCategory_1_idx (content_id, category_id, type), UNIQUE INDEX content_has_category_sluggable_idx (slug), PRIMARY KEY(content_id, category_id, type)) ENGINE = INNODB;
CREATE TABLE content_has_region (content_id BIGINT, region_id BIGINT, type VARCHAR(100), slug VARCHAR(255), UNIQUE INDEX IX_ContentHasRegion_1_idx (region_id, content_id, type), UNIQUE INDEX content_has_region_sluggable_idx (slug), PRIMARY KEY(content_id, region_id, type)) ENGINE = INNODB;
CREATE TABLE goverment_consultation (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, start_date DATE NOT NULL, end_date DATE, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX goverment_consultation_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE goverment_new (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX goverment_new_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE goverment_proposal (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX goverment_proposal_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE opinion (id BIGINT AUTO_INCREMENT, opinion VARCHAR(255) NOT NULL, opinion_possibility_id BIGINT, object_class VARCHAR(100) NOT NULL, object_id BIGINT NOT NULL, innapropiate TINYINT(1) DEFAULT '0' NOT NULL, selected TINYINT(1) DEFAULT '0' NOT NULL, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IX_Opinion_1_idx (object_class, object_id), INDEX opinion_possibility_id_idx (opinion_possibility_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE opinion_like (user_id BIGINT, opinion_id BIGINT, UNIQUE INDEX IX_OpinionLike_1_idx (user_id, opinion_id), PRIMARY KEY(user_id, opinion_id)) ENGINE = INNODB;
CREATE TABLE opinion_marked_as_spam (user_id BIGINT, opinion_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX IX_OpinionMarkedAsSpam_1_idx (user_id, opinion_id), PRIMARY KEY(user_id, opinion_id)) ENGINE = INNODB;
CREATE TABLE opinion_possibility_translation (id BIGINT, name VARCHAR(100) NOT NULL, lang CHAR(2), PRIMARY KEY(id, lang)) ENGINE = INNODB;
CREATE TABLE opinion_possibility (id BIGINT AUTO_INCREMENT, gmap_bubble_image VARCHAR(255), icon VARCHAR(255), opinion_possibility_group_id BIGINT, INDEX opinion_possibility_group_id_idx (opinion_possibility_group_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE opinion_possibility_group (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL UNIQUE, can_text_be_added TINYINT(1) DEFAULT '1' NOT NULL, show_stats TINYINT(1) DEFAULT '0' NOT NULL, slug VARCHAR(255), UNIQUE INDEX opinion_possibility_group_sluggable_idx (slug, name), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE proposal (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX proposal_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE region (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, description VARCHAR(255), root_id BIGINT, lft INT, rgt INT, level SMALLINT, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE response (id BIGINT AUTO_INCREMENT, body LONGTEXT NOT NULL, initiative_id BIGINT, slug VARCHAR(255), UNIQUE INDEX response_sluggable_idx (slug), INDEX initiative_id_idx (initiative_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE subscription_category (user_id BIGINT, category_id BIGINT, slug VARCHAR(255), UNIQUE INDEX IX_SubscriptionCategory_1_idx (user_id, category_id), UNIQUE INDEX subscription_category_sluggable_idx (slug), PRIMARY KEY(user_id, category_id)) ENGINE = INNODB;
CREATE TABLE subscription_region (user_id BIGINT, region_id BIGINT, slug VARCHAR(255), UNIQUE INDEX IX_SubscriptionRegion_1_idx (user_id, region_id), UNIQUE INDEX subscription_region_sluggable_idx (slug), PRIMARY KEY(user_id, region_id)) ENGINE = INNODB;
CREATE TABLE virtual_meeting (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, user_id BIGINT NOT NULL, answers_start_date DATE NOT NULL, answers_end_date DATE NOT NULL, slug VARCHAR(255), UNIQUE INDEX virtual_meeting_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE virtual_meeting_answer (id BIGINT AUTO_INCREMENT, answer LONGTEXT NOT NULL, opinion_id BIGINT NOT NULL, user_id BIGINT NOT NULL, slug VARCHAR(255), UNIQUE INDEX virtual_meeting_answer_sluggable_idx (slug), INDEX opinion_id_idx (opinion_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE workshop (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, video VARCHAR(255), active TINYINT(1) DEFAULT '1' NOT NULL, views BIGINT DEFAULT 0, user_id BIGINT NOT NULL, author VARCHAR(150) NOT NULL, action_date DATE, location VARCHAR(255), min_users_allowed BIGINT NOT NULL, max_users_allowed BIGINT, register_start_date DATE NOT NULL, register_end_date DATE, price DECIMAL(18, 2) DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, UNIQUE INDEX workshop_sluggable_idx (slug), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_profile (user_id BIGINT UNIQUE, born_date DATE, gender BIGINT, telephone VARCHAR(25), address VARCHAR(255), postal_code VARCHAR(10), location VARCHAR(150), province VARCHAR(150), country VARCHAR(150), web VARCHAR(255), about LONGTEXT, subscription_email TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, latitude DOUBLE(18, 2), longitude DOUBLE(18, 2), image VARCHAR(255), image_x1 BIGINT, image_y1 BIGINT, image_x2 BIGINT, image_y2 BIGINT, PRIMARY KEY(user_id)) ENGINE = INNODB;
ALTER TABLE action ADD CONSTRAINT action_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE action_has_category ADD CONSTRAINT action_has_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE;
ALTER TABLE action_has_user ADD CONSTRAINT action_has_user_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE citizen_action ADD CONSTRAINT citizen_action_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE citizen_proposal ADD CONSTRAINT citizen_proposal_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE comment ADD CONSTRAINT comment_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE comment ADD CONSTRAINT comment_reply_comment_id FOREIGN KEY (reply) REFERENCES comment(id);
ALTER TABLE comment_report ADD CONSTRAINT comment_report_id_comment_comment_id FOREIGN KEY (id_comment) REFERENCES comment(id) ON DELETE CASCADE;
ALTER TABLE content ADD CONSTRAINT content_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE content_has_category ADD CONSTRAINT content_has_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE;
ALTER TABLE content_has_region ADD CONSTRAINT content_has_region_region_id_region_id FOREIGN KEY (region_id) REFERENCES region(id) ON DELETE CASCADE;
ALTER TABLE goverment_consultation ADD CONSTRAINT goverment_consultation_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE goverment_new ADD CONSTRAINT goverment_new_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE goverment_proposal ADD CONSTRAINT goverment_proposal_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE opinion ADD CONSTRAINT opinion_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE opinion ADD CONSTRAINT opinion_opinion_possibility_id_opinion_possibility_id FOREIGN KEY (opinion_possibility_id) REFERENCES opinion_possibility(id) ON DELETE CASCADE;
ALTER TABLE opinion_like ADD CONSTRAINT opinion_like_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE opinion_like ADD CONSTRAINT opinion_like_opinion_id_opinion_id FOREIGN KEY (opinion_id) REFERENCES opinion(id) ON DELETE CASCADE;
ALTER TABLE opinion_marked_as_spam ADD CONSTRAINT opinion_marked_as_spam_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id);
ALTER TABLE opinion_marked_as_spam ADD CONSTRAINT opinion_marked_as_spam_opinion_id_opinion_id FOREIGN KEY (opinion_id) REFERENCES opinion(id);
ALTER TABLE opinion_possibility_translation ADD CONSTRAINT opinion_possibility_translation_id_opinion_possibility_id FOREIGN KEY (id) REFERENCES opinion_possibility(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE opinion_possibility ADD CONSTRAINT oooi FOREIGN KEY (opinion_possibility_group_id) REFERENCES opinion_possibility_group(id) ON DELETE CASCADE;
ALTER TABLE proposal ADD CONSTRAINT proposal_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE response ADD CONSTRAINT response_initiative_id_content_id FOREIGN KEY (initiative_id) REFERENCES content(id) ON DELETE CASCADE;
ALTER TABLE subscription_category ADD CONSTRAINT subscription_category_user_id_sf_guard_user_profile_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user_profile(user_id) ON DELETE CASCADE;
ALTER TABLE subscription_category ADD CONSTRAINT subscription_category_category_id_category_id FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE;
ALTER TABLE subscription_region ADD CONSTRAINT subscription_region_user_id_sf_guard_user_profile_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user_profile(user_id) ON DELETE CASCADE;
ALTER TABLE subscription_region ADD CONSTRAINT subscription_region_region_id_region_id FOREIGN KEY (region_id) REFERENCES region(id) ON DELETE CASCADE;
ALTER TABLE virtual_meeting ADD CONSTRAINT virtual_meeting_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE virtual_meeting_answer ADD CONSTRAINT virtual_meeting_answer_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE virtual_meeting_answer ADD CONSTRAINT virtual_meeting_answer_opinion_id_opinion_id FOREIGN KEY (opinion_id) REFERENCES opinion(id) ON DELETE CASCADE;
ALTER TABLE workshop ADD CONSTRAINT workshop_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
