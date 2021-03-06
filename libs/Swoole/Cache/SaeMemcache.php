<?php
namespace Swoole\Cache;
/**
 * Memcache封装类，支持memcache和memcached两种扩展
 * @author Tianfeng.Han
 * @package Swoole
 * @subpackage cache
 */
class SaeMemcache implements \Swoole\ICache
{
    public $multi = false;
    //启用压缩
    static $compress = MEMCACHE_COMPRESSED;
    public $cache;

    function __construct($configs)
    {
        $this->cache = \memcache_init();
        if($this->cache === false)
        {
            throw new \Exception("SaeMemcache init fail", 1);
        }
    }
    /**
     * 获取数据
     * @see libs/system/ICache#get($key)
     */
    function get($key)
    {
        return \memcache_get($key);
    }
    function set($key, $value, $expire=0)
    {
        return \memcache_set($key, $value, self::$compress, $expire);
    }
    function delete($key)
    {
        return \memcache_delete($key);
    }
}