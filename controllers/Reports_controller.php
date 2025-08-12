<?php

namespace WorldlangDict;

class Reports_controller
{
    public static function run($config, $request, $page)
    {
        $arg = isset($request->arguments[0]) ? $request->arguments[0] : '';

        // TODO: i18n
        $page->description = "Globasa reports";
        $page->title = "Reports";

        switch($arg) {
            case 'parse':
            case 'import':
                $page->setTitle('Import Report');
                $data = yaml_parse_file($config->api2Path.'reports/import_report.yaml');
                require_once('views/reports_parse_view.php');
                break;
            case 'changelog':
                require_once('models/Changelog.php');
                $data = Changelog::recent_changes($config);
                $page->setTitle('Changelog');
                require_once('views/reports_changelog_view.php');
                break;
            case 'new-terms':
                require_once('models/Changelog.php');
                $data = Changelog::new_terms($config);
                $defs = yaml_parse_file($config->basic_location . "{$config->lang}.yaml");
                $title = "New terms";
                $page->setTitle($title);
                $headline = "New terms in the word list.";
                require_once('views/reports_changelog_type_view.php');
                break;
            case 'removed-terms':
                require_once('models/Changelog.php');
                $data = Changelog::removed_terms($config);
                $title = "Removed terms";
                $page->setTitle($title);
                $headline = "Entries that have been removed.";
                require_once('views/reports_changelog_type_view.php');
                break;
            case 'updated-entries':
                require_once('models/Changelog.php');
                $data = Changelog::updated_entries($config);
                $defs = yaml_parse_file($config->basic_location . "{$config->lang}.yaml");
                $title = "Updated Entries";
                $page->setTitle($title);
                $headline = "Updates to entries.";
                require_once('views/reports_changelog_type_view.php');
                break;
            case '':
                require_once('views/reports_default_view.php');
                break;
            default:
                throw new Error_404_exception("Reports module not found.");
                break;
        }
    }
}
