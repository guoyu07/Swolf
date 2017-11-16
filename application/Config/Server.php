<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/10
 * @Time: 15:18
 */

namespace App\Config;

class Server
{
    const TCP_SERVER = 1;
    const UDP_SERVER = 2;
    const HTTP_SERVER = 3;
    const WEBSOCKET_SERVER = 4;

    public static $serverType = self::HTTP_SERVER;

    public static $setting = [

        //应用名称
        'app_name' => 'Swolf demo',

        //应用版本
        'app_version' => '0.1.0',

        //应用密钥，jwt认证使用
        'app_secret' => 'asfsdggegr3t2FQAfgwqasd',

        //监听的地址
        'host' => '127.0.0.1',

        //监听的端口
        'port' => 9501,

        //通过此参数来调节poll线程的数量，以充分利用多核
        'reactor_num' => 2,

        //设置启动的worker进程数量。
        //
        //swoole采用固定worker进程的模式。
        //PHP代码中是全异步非阻塞，worker_num配置为CPU核数的1-4倍即可。
        //如果是同步阻塞，worker_num配置为100或者更高，具体要看每次请求处理的耗时和操作系统负载状况。
        //当设定的worker进程数小于reactor线程数时，会自动调低reactor线程的数量
        'worker_num' => 4,

        //此参数将决定最多同时有多少个待accept的连接，swoole本身accept效率是很高的，基本上不会出现大量排队情况。
        'backlog' => 128,

        //此参数表示worker进程在处理完n次请求后结束运行。
        //
        //manager会重新创建一个worker进程。此选项用来防止worker进程内存溢出。
        //PHP代码也可以使用memory_get_usage来检测进程的内存占用情况，发现接近memory_limit时，调用exit()退出进程。
        //manager进程会回收此进程，然后重新启动一个新的Worker进程。
        //onConnect/onClose不增加计数
        'max_request' => 50,

        //worker进程数据包分配模式
        //
        //1平均分配，2按FD取模固定分配，3抢占式分配.
        //默认为取模(dispatch=2)
        //抢占式分配，每次都是空闲的worker进程获得数据。很合适SOA/RPC类的内部服务框架
        //当选择为dispatch=3抢占模式时，worker进程内发生onConnect/onReceive/onClose/onTimer会将worker进程标记为忙，不再接受新的请求。reactor会将新请求投递给其他状态为闲的worker进程
        //如果希望每个连接的数据分配给固定的worker进程，dispatch_mode需要设置为2
        'dispatch_mode' => 3,

        //此参数用来设置Server最大允许维持多少个tcp连接。
        //
        //超过此数量后，新进入的连接将被拒绝
        //此参数不要调整的过大，根据机器内存的实际情况来设置。
        //Swoole会根据此数值一次性分配一块大内存来保存Connection信息
        'max_conn' => 10000,

        //加入此参数后，执行php server.php将转入后台作为守护进程运行
        'daemonize' => 0,

        //启用CPU亲和设置
        'open_cpu_affinity' => 1,

        //启用tcp_nodelay
        'open_tcp_nodelay' => 1,

        //此参数设定一个秒数，当客户端连接连接到服务器时，在约定秒数内并不会触发accept，直到有数据发送，或者超时时才会触发。
        'tcp_defer_accept' => 5,

        //指定swoole错误日志文件。
        //
        //在swoole运行期发生的异常信息会记录到这个文件中
        //默认会打印到屏幕
        //此配置仅在swoole-1.5.8以上版本中可用
        'log_file ' => '/data/log/swoole.log',

        //buffer主要是用于检测数据是否完整，如果不完整swoole会继续等待新的数据到来。
        //直到收到完整的一个请求，才会一次性发送给worker进程。这时onReceive会收到一个超过SW_BUFFER_SIZE，
        //小于$serv->setting['package_max_length']的数据。
        //目前仅提供了EOF检测、固定包头长度检测2种buffer模式。
        //
        //打开buffer
        'open_eof_check ' => true,
        //设置EOF
        'package_eof ' => "\r\n\r\n",
        //包数据的最大长度，单位B
        'package_max_length' => 81920,

        //每隔多少秒检测一次，单位秒
        //Swoole会轮询所有TCP连接，将超过心跳时间的连接关闭掉
        'heartbeat_check_interval ' => 30,
        //TCP连接的最大闲置时间，单位s
        //如果某fd最后一次发包距离现在的时间超过heartbeat_idle_time会把这个连接关闭。
        'heartbeat_idle_time ' => 60,

    ];
}