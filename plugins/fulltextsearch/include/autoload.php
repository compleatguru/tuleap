<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
function autoload6e6b99ce3d20dcdad1a8315358574706($class) {
    static $classes = null;
    if ($classes === null) {
        $classes = array(
            'elasticsearch_1_2_requestdocmandatafactory' => '/ElasticSearch/RequestDocmanDataFactory.class.php',
            'elasticsearch_1_2_requesttrackerdatafactory' => '/ElasticSearch/RequestTrackerDataFactory.class.php',
            'elasticsearch_1_2_requestwikidatafactory' => '/ElasticSearch/RequestWikiDataFactory.class.php',
            'elasticsearch_1_2_resultfactory' => '/ElasticSearch/ResultFactory.class.php',
            'elasticsearch_clientfacade' => '/ElasticSearch/ClientFacade.class.php',
            'elasticsearch_clientfactory' => '/ElasticSearch/ClientFactory.class.php',
            'elasticsearch_clientnotfoundexception' => '/ElasticSearch/ClientNotFoundException.class.php',
            'elasticsearch_elementnotindexed' => '/ElasticSearch/ElementNotIndexed.class.php',
            'elasticsearch_indexclientfacade' => '/ElasticSearch/IndexClientFacade.class.php',
            'elasticsearch_searchadminclientfacade' => '/ElasticSearch/SearchAdminClientFacade.class.php',
            'elasticsearch_searchclientfacade' => '/ElasticSearch/SearchClientFacade.class.php',
            'elasticsearch_searchresult' => '/ElasticSearch/SearchResult.class.php',
            'elasticsearch_searchresultcollection' => '/ElasticSearch/SearchResultCollection.class.php',
            'elasticsearch_searchresultdocman' => '/ElasticSearch/SearchResultDocman.class.php',
            'elasticsearch_searchresultprojectsfacet' => '/ElasticSearch/SearchResultProjectsFacet.class.php',
            'elasticsearch_searchresultprojectsfacetcollection' => '/ElasticSearch/SearchResultProjectsFacetCollection.class.php',
            'elasticsearch_searchresulttracker' => '/ElasticSearch/SearchResultTracker.class.php',
            'elasticsearch_searchresultwiki' => '/ElasticSearch/SearchResultWiki.class.php',
            'elasticsearch_transporthttpbasicauth' => '/ElasticSearch/TransportHTTPBasicAuth.class.php',
            'elasticsearch_typenotindexed' => '/ElasticSearch/TypeNotIndexed.class.php',
            'fulltextsearch_controller_admin' => '/FullTextSearch/Controller/AdminController.class.php',
            'fulltextsearch_controller_search' => '/FullTextSearch/Controller/SearchController.class.php',
            'fulltextsearch_controller_searcherror' => '/FullTextSearch/Controller/SearchErrorController.class.php',
            'fulltextsearch_docmansystemeventmanager' => '/FullTextSearch/DocmanSystemEventManager.class.php',
            'fulltextsearch_iindexdocuments' => '/FullTextSearch/IIndexDocuments.class.php',
            'fulltextsearch_isearchdocuments' => '/FullTextSearch/ISearchDocuments.class.php',
            'fulltextsearch_isearchdocumentsforadmin' => '/FullTextSearch/ISearchDocumentsForAdmin.class.php',
            'fulltextsearch_presenter_adminpresenter' => '/FullTextSearch/Presenter/AdminPresenter.class.php',
            'fulltextsearch_presenter_errornosearch' => '/FullTextSearch/Presenter/ErrorNoSearch.class.php',
            'fulltextsearch_presenter_facetpresenter' => '/FullTextSearch/Presenter/FacetPresenter.class.php',
            'fulltextsearch_presenter_projectpresenter' => '/FullTextSearch/Presenter/ProjectPresenter.class.php',
            'fulltextsearch_presenter_search' => '/FullTextSearch/Presenter/Search.class.php',
            'fulltextsearch_presenter_searchmore' => '/FullTextSearch/Presenter/SearchMore.class.php',
            'fulltextsearch_searchresultcollection' => '/FullTextSearch/SearchResultCollection.class.php',
            'fulltextsearch_trackersystemeventmanager' => '/FullTextSearch/TrackerSystemEventManager.class.php',
            'fulltextsearch_wikisystemeventmanager' => '/FullTextSearch/WikiSystemEventManager.class.php',
            'fulltextsearchdocmanactions' => '/FullTextSearchDocmanActions.class.php',
            'fulltextsearchplugin' => '/fulltextsearchPlugin.class.php',
            'fulltextsearchplugindescriptor' => '/FulltextsearchPluginDescriptor.class.php',
            'fulltextsearchplugininfo' => '/FulltextsearchPluginInfo.class.php',
            'fulltextsearchsystemeventqueue' => '/FullTextSearchSystemEventQueue.class.php',
            'fulltextsearchtrackeractions' => '/FullTextSearchTrackerActions.class.php',
            'fulltextsearchwikiactions' => '/FullTextSearchWikiActions.class.php',
            'systemevent_fulltextsearch_docman' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN.class.php',
            'systemevent_fulltextsearch_docman_approval_table_comment' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_APPROVAL_TABLE_COMMENT.class.php',
            'systemevent_fulltextsearch_docman_copy' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_COPY.class.php',
            'systemevent_fulltextsearch_docman_delete' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_DELETE.class.php',
            'systemevent_fulltextsearch_docman_empty_index' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_EMPTY_INDEX.class.php',
            'systemevent_fulltextsearch_docman_folder_index' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_FOLDER_INDEX.class.php',
            'systemevent_fulltextsearch_docman_index' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_INDEX.class.php',
            'systemevent_fulltextsearch_docman_link_index' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_LINK_INDEX.class.php',
            'systemevent_fulltextsearch_docman_reindex_project' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_REINDEX_PROJECT.class.php',
            'systemevent_fulltextsearch_docman_update' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_UPDATE.class.php',
            'systemevent_fulltextsearch_docman_update_metadata' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_UPDATE_METADATA.class.php',
            'systemevent_fulltextsearch_docman_update_permissions' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_UPDATE_PERMISSIONS.class.php',
            'systemevent_fulltextsearch_docman_wiki_index' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_WIKI_INDEX.class.php',
            'systemevent_fulltextsearch_docman_wiki_update' => '/SystemEvent_FULLTEXTSEARCH_DOCMAN_WIKI_UPDATE.class.php',
            'systemevent_fulltextsearch_tracker_artifact_delete' => '/SystemEvent_FULLTEXTSEARCH_TRACKER_ARTIFACT_DELETE.class.php',
            'systemevent_fulltextsearch_tracker_artifact_update' => '/SystemEvent_FULLTEXTSEARCH_TRACKER_ARTIFACT_UPDATE.class.php',
            'systemevent_fulltextsearch_tracker_reindex_project' => '/SystemEvent_FULLTEXTSEARCH_TRACKER_REINDEX_PROJECT.class.php',
            'systemevent_fulltextsearch_tracker_tracker_delete' => '/SystemEvent_FULLTEXTSEARCH_TRACKER_TRACKER_DELETE.class.php',
            'systemevent_fulltextsearch_wiki' => '/SystemEvent_FULLTEXTSEARCH_WIKI.class.php',
            'systemevent_fulltextsearch_wiki_delete' => '/SystemEvent_FULLTEXTSEARCH_WIKI_DELETE.class.php',
            'systemevent_fulltextsearch_wiki_index' => '/SystemEvent_FULLTEXTSEARCH_WIKI_INDEX.class.php',
            'systemevent_fulltextsearch_wiki_reindex_project' => '/SystemEvent_FULLTEXTSEARCH_WIKI_REINDEX_PROJECT.class.php',
            'systemevent_fulltextsearch_wiki_update' => '/SystemEvent_FULLTEXTSEARCH_WIKI_UPDATE.class.php',
            'systemevent_fulltextsearch_wiki_update_permissions' => '/SystemEvent_FULLTEXTSEARCH_WIKI_UPDATE_PERMISSIONS.class.php',
            'systemevent_fulltextsearch_wiki_update_service_permissions' => '/SystemEvent_FULLTEXTSEARCH_WIKI_UPDATE_SERVICE_PERMISSIONS.class.php'
        );
    }
    $cn = strtolower($class);
    if (isset($classes[$cn])) {
        require dirname(__FILE__) . $classes[$cn];
    }
}
spl_autoload_register('autoload6e6b99ce3d20dcdad1a8315358574706');
// @codeCoverageIgnoreEnd