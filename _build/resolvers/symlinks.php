<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/multiSite/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/multisite')) {
            $cache->deleteTree(
                $dev . 'assets/components/multisite/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/multisite/', $dev . 'assets/components/multisite');
        }
        if (!is_link($dev . 'core/components/multisite')) {
            $cache->deleteTree(
                $dev . 'core/components/multisite/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/multisite/', $dev . 'core/components/multisite');
        }
    }
}

return true;