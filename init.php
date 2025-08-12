<?php
namespace WorldlangDict;

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_regex_encoding('UTF-8');

/* Source files */
require_once 'router.php';
require_once 'resources/downloadFile.php';
require_once 'resources/loadCsv.php';
require_once 'resources/custom_exceptions.php';
require_once 'WorldlangDictUtils.php';
require_once 'models/WorldlangDictConfig.php';
require_once 'models/Request.php';
require_once 'models/Page.php';
require_once 'models/Tool.php';
require_once 'models/Homonym.php';
require_once 'models/Minimal_pair.php';
require_once 'models/Translation_aid.php';
require_once 'controllers/Word_controller.php';
require_once 'controllers/Search_controller.php';
require_once 'controllers/Feedback_controller.php';
require_once 'controllers/Browse_controller.php';
require_once 'controllers/Dev_controller.php';
require_once 'controllers/Error_controller.php';
require_once 'controllers/Homonym_controller.php';
require_once 'controllers/Minimal_pair_controller.php';
require_once 'controllers/Candidate_word_controller.php';
require_once 'controllers/Translation_aide_controller.php';
require_once 'controllers/Welcome_controller.php';
require_once 'controllers/Tags_controller.php';
require_once 'controllers/Tool_controller.php';

$config = new WorldlangDictConfig();
require_once 'config.php';
