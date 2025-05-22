<?php
namespace WorldlangDict;

/**
 * Calls the appropriate function based on the url.
 */
function router(WorldlangDictConfig $config)
{
    $page = new Page($config->getTrans('App Name'));

    $request = new Request($config);

    if ($request->incomplete) {
        WorldlangDictUtils::redirect($config=$config, $request=$request);
    }
    $config->setLang($request->lang);

    try {
        switch ($request->controller) {
            case 'tools':
            case 'tul': // Globasa
                Tool_controller::run($config, $request, $page);
                break;
            case 'words':
            case 'lexi': // Globasa
                Word_controller::output_entry($config, $request, $page);
                break;
            case 'natlang-search':
            case 'cel-ruke': // Globasa
                Word_controller::addNatWord($config, $request, $config->lang, $page);
                break;
            case 'search':
            case 'xerca': // Globasa
                Search_controller::search($config, $request, $page);
                break;
            case 'feedback':
            case 'am-reporte': // Globasa
                Feedback_controller::feedback($config, $request, $page);
                break;
            case 'tags':
            case 'lexilari': // Globasa
                Tags_controller::addTags($config, $request, $page);
                break;
            case 'browse':
            case 'abeceli-menalari': // Globasa
                Browse_controller::default($config, $request, $page);
                break;
            case 'natlangs':
            case 'estatisti-fe-lexiasel': // Globasa
                require_once('controllers/Natlangs_controller.php');
                Natlangs_controller::run($config, $request, $page);
                break;
            case 'natlang-browse':
            case 'natlang-abeceli': // Globasa
                require_once('controllers/Natlang_browse_controller.php');
                Natlang_browse_controller::default($config, $request, $page);
                break;
            case 'stats':
            case 'estatisti': // Globasa
                require_once('controllers/Statistics_controller.php');
                Statistics_controller::default($config, $request, $page);
                break;
            case 'reports':
                require_once('controllers/Reports_controller.php');
                Reports_controller::run($config, $request, $page);
                break;
            case 'test':
                Test_controller::helloWorld($config, $request, $page);
                break;
            case '':
                Welcome_controller::home($config, $request, $page);
                break;
            default:
                throw new Error_404_Exception("Invalid controller");
        }
    } catch (Error_404_Exception $e) {
        Error_controller::error_404($config, $request, $page);
    } catch (Error_loading_data_exception $e) {
        Error_controller::data_error($config, $request, $page);
    } catch (Error_invalid_request_exception $e) {
        Error_controller::invalid_request($config, $request, $page);
    } catch(\Throwable $t) {
        if ($config->debugging) {
            Error_controller::debug($config, $request, $page, $t);
        }
        Error_controller::wtf($config, $request, $page);
    }
}
