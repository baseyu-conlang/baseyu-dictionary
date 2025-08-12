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
            case 'tool': case $config->routes['tool']:
                Tool_controller::run($config, $request, $page);
                break;
            case 'word': case $config->routes['word']:
                Word_controller::output_entry($config, $request, $page);
                break;
            case 'natlang-search': case $config->routes['natlang-search']:
                Word_controller::addNatWord($config, $request, $config->lang, $page);
                break;
            case 'search': case $config->routes['search']:
                Search_controller::search($config, $request, $page);
                break;
            case 'feedback': case $config->routes['feedback']:
                Feedback_controller::feedback($config, $request, $page);
                break;
            case 'tag': case $config->routes['tag']:
                Tags_controller::addTags($config, $request, $page);
                break;
            case 'browse': case $config->routes['browse']:
                Browse_controller::default($config, $request, $page);
                break;
            case 'natlang': case $config->routes['natlang']:
                require_once('controllers/Natlangs_controller.php');
                Natlangs_controller::run($config, $request, $page);
                break;
            case 'natlang-browse': case $config->routes['natlang-browse']:
                require_once('controllers/Natlang_browse_controller.php');
                Natlang_browse_controller::default($config, $request, $page);
                break;
            case 'stats': case $config->routes['stats']:
                require_once('controllers/Statistics_controller.php');
                Statistics_controller::default($config, $request, $page);
                break;
            case 'report': case $config->routes['report']:
                require_once('controllers/Reports_controller.php');
                Reports_controller::run($config, $request, $page);
                break;
            case 'dev-dash': case $config->routes['dev-dash']:
                Dev_controller::dash($config, $request, $page);
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
        Error_controller::wtf(config:$config, request:$request, page:$page, error:$t);
    }
}
