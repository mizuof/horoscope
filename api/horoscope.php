<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// 星座
const ZODIAC_CONFIG = [
    'aries' => [
        'name' => '白羊座',
        'color' => '#FF6B6B',
        'element' => '火象星座',
        'lucky_day' => '星期二'
    ],
    'taurus' => [
        'name' => '金牛座',
        'color' => '#4ECDC4',
        'element' => '土象星座',
        'lucky_day' => '星期五'
    ],
    'gemini' => [
        'name' => '双子座',
        'color' => '#45B7D1',
        'element' => '风象星座',
        'lucky_day' => '星期三'
    ],
    'cancer' => [
        'name' => '巨蟹座',
        'color' => '#FFBE0B',
        'element' => '水象星座',
        'lucky_day' => '星期一'
    ],
    'leo' => [
        'name' => '狮子座',
        'color' => '#FB5607',
        'element' => '火象星座',
        'lucky_day' => '星期日'
    ],
    'virgo' => [
        'name' => '处女座',
        'color' => '#83C5BE',
        'element' => '土象星座',
        'lucky_day' => '星期三'
    ],
    'libra' => [
        'name' => '天秤座',
        'color' => '#FFDDD2',
        'element' => '风象星座',
        'lucky_day' => '星期五'
    ],
    'scorpio' => [
        'name' => '天蝎座',
        'color' => '#E29578',
        'element' => '水象星座',
        'lucky_day' => '星期二'
    ],
    'sagittarius' => [
        'name' => '射手座',
        'color' => '#FF006E',
        'element' => '火象星座',
        'lucky_day' => '星期四'
    ],
    'capricorn' => [
        'name' => '摩羯座',
        'color' => '#3A86FF',
        'element' => '土象星座',
        'lucky_day' => '星期六'
    ],
    'aquarius' => [
        'name' => '水瓶座',
        'color' => '#8338EC',
        'element' => '风象星座',
        'lucky_day' => '星期六'
    ],
    'pisces' => [
        'name' => '双鱼座',
        'color' => '#00BBF9',
        'element' => '水象星座',
        'lucky_day' => '星期四'
    ]
];

class ContentLibrary {
    public static function getHealthEvaluation($score) {
        $evaluations = [
            [90, 100, ['身体状态极佳', '生理机能优异', '健康指数达到峰值']],
            [75, 89, ['健康状况良好', '身体状态稳定', '生理指标正常']],
            [60, 74, ['轻度疲劳状态', '需注意休息恢复', '亚健康预警']],
            [0, 59, ['健康状态不佳', '需医学关注', '身体机能下降']]
        ];
        return self::getEvaluation($score, $evaluations);
    }

    public static function getLoveEvaluation($score) {
        $evaluations = [
            [90, 100, ['感情状态极佳', '亲密关系和谐', '情感交流顺畅']],
            [75, 89, ['感情发展稳定', '关系互动良好', '情感连接紧密']],
            [60, 74, ['需加强沟通', '关系有待改善', '情感维系必要']],
            [0, 59, ['情感关系紧张', '需危机处理', '连接出现障碍']]
        ];
        return self::getEvaluation($score, $evaluations);
    }

    public static function getCareerEvaluation($score) {
        $evaluations = [
            [90, 100, ['事业发展顺利', '工作表现突出', '职业机遇显现']],
            [75, 89, ['工作推进稳定', '专业能力提升', '项目进展有序']],
            [60, 74, ['遇到工作瓶颈', '需技能提升', '需调整策略']],
            [0, 59, ['职业压力显著', '工作效率下降', '需职业指导']]
        ];
        return self::getEvaluation($score, $evaluations);
    }

    private static function getEvaluation($score, $ranges) {
        foreach ($ranges as $range) {
            if ($score >= $range[0] && $score <= $range[1]) {
                return $range[2][array_rand($range[2])];
            }
        }
        return '状态平稳';
    }

    public static function getElementTraits($element) {
        $traits = [
            '火象星座' => [
                '行动力强且富有领导力',
                '决策迅速且执行力突出',
                '精力充沛且抗压能力强'
            ],
            '土象星座' => [
                '务实稳重且可靠度高',
                '注重细节且组织力强',
                '持久力佳且资源管理能力突出'
            ],
            '风象星座' => [
                '思维敏捷且沟通力强',
                '适应性强且学习力突出',
                '创新思维且信息处理高效'
            ],
            '水象星座' => [
                '情感敏锐且直觉准确',
                '共情能力强且人际关系和谐',
                '创造力丰富且艺术感知力强'
            ]
        ];
        return $traits[$element][array_rand($traits[$element])];
    }

    public static function getLuckyNumber() {
        $numbers = [1, 3, 5, 7, 9, 11, 13, 15, 17, 20, 22, 25, 27, 29, 31, 33, 35];
        return $numbers[array_rand($numbers)];
    }

    public static function getLuckyColor() {
        $colors = [
            '古典红' => '#9A1F1A',
            '孔雀蓝' => '#0047AB',
            '翡翠绿' => '#2C5545',
            '帝王紫' => '#5D3FD3',
            '香槟金' => '#F0E68C',
            '月光银' => '#C0C0C0',
            '樱花粉' => '#FFB7C5',
            '落日橙' => '#FF7F50',
            '星空蓝' => '#1E3F66',
            '薄荷绿' => '#3EB489'
        ];
        $name = array_rand($colors);
        return ['name' => $name, 'hex' => $colors[$name]];
    }

    public static function getLuckyTime() {
        $times = [
            '凌晨时段 (03:00-05:00)',
            '上午时段 (09:00-11:00)',
            '午后时段 (13:00-15:00)',
            '傍晚时段 (17:00-19:00)',
            '夜间时段 (21:00-23:00)'
        ];
        return $times[array_rand($times)];
    }

    public static function getAdvice($category) {
        $advices = [
            'health' => [
                '保持规律作息时间',
                '增加有氧运动频率',
                '注意饮食营养均衡'
            ],
            'love' => [
                '主动表达情感需求',
                '安排专属相处时间',
                '共同参与兴趣活动'
            ],
            'career' => [
                '制定明确工作计划',
                '优先处理重要任务',
                '学习时间管理技巧'
            ]
        ];
        return $advices[$category][array_rand($advices[$category])];
    }
}

// 主处理逻辑
try {
    // 参数验证
    if (!isset($_GET['sign'])) {
        throw new Exception('请指定星座参数');
    }
    $sign = strtolower($_GET['sign']);
    
    if (!array_key_exists($sign, ZODIAC_CONFIG)) {
        throw new Exception('无效的星座标识');
    }
    
    // 缓存处理
    $cacheDir = __DIR__ . '/cache/';
    if (!file_exists($cacheDir)) {
        if (!mkdir($cacheDir, 0755, true)) {
            throw new Exception('无法创建缓存目录');
        }
    }
    
    $cacheFile = $cacheDir . date('Y-m-d') . '_' . $sign . '.json';
    
    if (!file_exists($cacheFile)) {
        // 生成运势数据
        $scores = [
            'health' => rand(50, 100),
            'love' => rand(40, 100),
            'career' => rand(60, 100)
        ];
        
        $overallScore = round(($scores['health'] + $scores['love'] + $scores['career']) / 3);
        
        $reportData = [
            'basic_info' => [
                'name' => ZODIAC_CONFIG[$sign]['name'],
                'color' => ZODIAC_CONFIG[$sign]['color'],
                'element' => ZODIAC_CONFIG[$sign]['element'],
                'date' => date('Y-m-d')
            ],
            'lucky' => [
                'number' => ContentLibrary::getLuckyNumber(),
                'color' => ContentLibrary::getLuckyColor(),
                'time' => ContentLibrary::getLuckyTime(),
                'day' => ZODIAC_CONFIG[$sign]['lucky_day']
            ],
            'analysis' => [
                'health' => [
                    'score' => $scores['health'],
                    'evaluation' => ContentLibrary::getHealthEvaluation($scores['health']),
                    'advice' => ContentLibrary::getAdvice('health')
                ],
                'love' => [
                    'score' => $scores['love'],
                    'evaluation' => ContentLibrary::getLoveEvaluation($scores['love']),
                    'advice' => ContentLibrary::getAdvice('love')
                ],
                'career' => [
                    'score' => $scores['career'],
                    'evaluation' => ContentLibrary::getCareerEvaluation($scores['career']),
                    'advice' => ContentLibrary::getAdvice('career')
                ],
                'element_traits' => ContentLibrary::getElementTraits(ZODIAC_CONFIG[$sign]['element'])
            ],
            'overall_score' => $overallScore,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // 写入缓存
        if (file_put_contents($cacheFile, json_encode($reportData, JSON_UNESCAPED_UNICODE)) === false) {
            throw new Exception('无法写入缓存文件');
        }
    } else {
        $reportData = json_decode(file_get_contents($cacheFile), true);
        if ($reportData === null) {
            throw new Exception('缓存数据读取失败');
        }
    }
    
    // 输出结果
    echo json_encode($reportData, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'error' => true,
        'message' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
