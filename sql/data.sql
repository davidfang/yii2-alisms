CREATE TABLE `sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tmp_id` int(11) NOT NULL COMMENT '模板名',
  `mobile` VARCHAR (11) DEFAULT NULL,
  `content` varchar(200) NOT NULL COMMENT '内容',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `result` varchar(500) DEFAULT NULL COMMENT '结果',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `tmp_id_idx` (`tmp_id`),
  CONSTRAINT `tmp_id` FOREIGN KEY (`tmp_id`) REFERENCES `sms_template` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

REATE TABLE `sms_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appkey` varchar(45) NOT NULL,
  `secretKey` varchar(45) NOT NULL,
  `sms_free_sign_name` varchar(45) NOT NULL COMMENT '短信签名',
  `name` varchar(45) NOT NULL COMMENT '模板名称',
  `tmpId` varchar(45) NOT NULL COMMENT '模板ID(阿里)',
  `content` varchar(500) NOT NULL COMMENT '内容',
  `param` varchar(200) NOT NULL COMMENT '参数(json格式）',
  `status` smallint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `captcha` smallint(1) NOT NULL DEFAULT '0' COMMENT '验证码',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;