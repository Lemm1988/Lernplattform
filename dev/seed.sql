-- Beispieldaten für die LOKALE Testdatenbank (lernplattform_dev).
-- Wird von dev/setup_db.php nach Database.sql eingespielt. NICHT auf dem Live-Server ausführen!
--
-- Demo-Zugänge:
--   admin@lernplattform.local      / Admin123!
--   moderator@lernplattform.local  / Moderator123!
--   schueler@lernplattform.local   / Schueler123!

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `role`, `is_active`, `privacy_consent`, `avatar`) VALUES
(1, 'admin',     'admin@lernplattform.local',     '$2y$10$uoUWD8xKKNeLiRnXZXVjqOzGOHsO3Lq8fkrXOWIWx2Q0hSKY5lsj.', 'admin',     1, 1, '1'),
(2, 'moderator', 'moderator@lernplattform.local', '$2y$10$Da/4tW9.FX49jJow8.qAZOxEpl.IXdrH.CPHJtSmx5FiTDX9BhQLy', 'moderator', 1, 1, '5'),
(3, 'schueler',  'schueler@lernplattform.local',  '$2y$10$E49UJyY7ptHHNH.NQW3FP.hGZenw/XK5dkSTBmipdmTw6f6qWu4l6', 'student',   1, 1, '9');

INSERT INTO `learning_fields` (`id`, `lf_number`, `title`, `description`, `specialization`, `sort_order`) VALUES
(1,  'LF1',  'Unternehmen und eigene Rolle', NULL, 'all', 1),
(2,  'LF2',  'Geschäftsprozesse und betriebliche Organisation', NULL, 'all', 2),
(3,  'LF3',  'Informationsquellen und Arbeitsmethoden', NULL, 'all', 3),
(4,  'LF4',  'Benutzerunterstützung und kundenorientierte Kommunikation', NULL, 'all', 4),
(5,  'LF5',  'Datenbanken entwickeln und anpassen', NULL, 'all', 5),
(6,  'LF6',  'IT-Systeme integrieren', NULL, 'all', 6),
(7,  'LF7',  'IT-Sicherheit', NULL, 'all', 7),
(8,  'LF8',  'Markt- und Kundenbeziehungen', NULL, 'all', 8),
(9,  'LF9',  'Öffentliche Netze und Dienste', NULL, 'all', 9),
(10, 'LF10', 'Betreuen von IT-Systemen', NULL, 'all', 10),
(11, 'LF11', 'Entwickeln und Bereitstellen von Anwendungssystemen', NULL, 'all', 11),
(12, 'LF12', 'Projektarbeit', NULL, 'all', 12);

INSERT INTO `site_section_headers` (`name`, `section_type`, `icon`, `sort_order`) VALUES
('Übersicht',       'main',           'bi-house',            1),
('Lernfelder',      'lernfelder',     'bi-journal-bookmark', 2),
('Programmierung',  'programmierung', 'bi-code-slash',       3),
('Agile Methoden',  'agil',           'bi-kanban',           4),
('IT-Games',        'games',          'bi-controller',       5);

INSERT INTO `site_sections` (`id`, `name`, `url_path`, `icon`, `section_type`, `sort_order`, `roles`) VALUES
(1,  'Dashboard',          '/',                                          'bi-speedometer2',     'main', 1, 'admin,moderator,student'),
(2,  'Quiz starten',       '/quiz/start_quiz.php',                       'bi-play-circle',      'main', 2, 'admin,moderator,student'),
(3,  'News',               '/news/',                                     'bi-newspaper',        'main', 3, 'admin,moderator,student'),
(4,  'Frage einreichen',   '/users/frage_einreichen.php',                'bi-lightbulb',        'main', 4, 'admin,moderator,student'),
(5,  'Nachrichten',        '/users/kontakt.php',                         'bi-envelope',         'main', 5, 'admin,moderator,student'),
(10, 'LF1 Unternehmen & Rolle',          '/Learningfields/LF1/index.php',  'bi-building',     'lernfelder', 1,  'admin,moderator,student'),
(11, 'LF2 Geschäftsprozesse',            '/Learningfields/LF2/index.php',  'bi-diagram-3',    'lernfelder', 2,  'admin,moderator,student'),
(12, 'LF3 Arbeitsmethoden',              '/Learningfields/LF3/index.php',  'bi-search',       'lernfelder', 3,  'admin,moderator,student'),
(13, 'LF4 Benutzerunterstützung',        '/Learningfields/LF4/index.php',  'bi-headset',      'lernfelder', 4,  'admin,moderator,student'),
(14, 'LF5 Datenbanken',                  '/Learningfields/LF5/index.php',  'bi-database',     'lernfelder', 5,  'admin,moderator,student'),
(15, 'LF6 Systeme integrieren',          '/Learningfields/LF6/index.php',  'bi-plug',         'lernfelder', 6,  'admin,moderator,student'),
(16, 'LF7 IT-Sicherheit',                '/Learningfields/LF7/index.php',  'bi-shield-lock',  'lernfelder', 7,  'admin,moderator,student'),
(17, 'LF8 Markt & Kunden',               '/Learningfields/LF8/index.php',  'bi-graph-up',     'lernfelder', 8,  'admin,moderator,student'),
(18, 'LF9 Netze & Dienste',              '/Learningfields/LF9/index.php',  'bi-globe',        'lernfelder', 9,  'admin,moderator,student'),
(19, 'LF10 IT-Systeme betreuen',         '/Learningfields/LF10/index.php', 'bi-hdd-network',  'lernfelder', 10, 'admin,moderator,student'),
(20, 'LF11 Anwendungssysteme',           '/Learningfields/LF11/index.php', 'bi-window-stack', 'lernfelder', 11, 'admin,moderator,student'),
(21, 'LF12 Projektarbeit',               '/Learningfields/LF12/index.php', 'bi-kanban',       'lernfelder', 12, 'admin,moderator,student'),
(30, 'Java',               '/programming/java/java-index.php',           'bi-cup-hot',          'programmierung', 1, 'admin,moderator,student'),
(31, 'PHP',                '/programming/php/php-index.php',             'bi-filetype-php',     'programmierung', 2, 'admin,moderator,student'),
(32, 'Python',             '/programming/python/python-index.php',       'bi-filetype-py',      'programmierung', 3, 'admin,moderator,student'),
(40, 'Scrum Foundation',   '/Learningfields/Scrum/Scrum_Fundation_index.php', 'bi-people',      'agil', 1, 'admin,moderator,student');

INSERT INTO `settings` (`setting_key`, `setting_value`, `description`) VALUES
('site_title', 'Lernplattform (lokal)', 'Titel der Website'),
('maintenance_mode', '0', 'Wartungsmodus');
