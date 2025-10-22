<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// 星座基础数据配置
const ZODIAC_CONFIG = [
    'aries' => [
        'name' => '白羊座',
        'color' => '#FF6B6B',
        'element' => '火象星座',
        'lucky_day' => '星期二',
        'date_range' => '3月21日-4月19日',
        'ruling_planet' => '火星',
        'personality' => '勇敢、热情、冲动、领导力强',
        'strengths' => ['行动力强', '充满激情', '直率坦诚'],
        'weaknesses' => ['急躁', '缺乏耐心', '容易冲动']
    ],
    'taurus' => [
        'name' => '金牛座',
        'color' => '#4ECDC4',
        'element' => '土象星座',
        'lucky_day' => '星期五',
        'date_range' => '4月20日-5月20日',
        'ruling_planet' => '金星',
        'personality' => '稳重、务实、耐心、享受生活',
        'strengths' => ['可靠稳定', '有耐心', '艺术鉴赏力强'],
        'weaknesses' => ['固执', '保守', '物质主义']
    ],
    'gemini' => [
        'name' => '双子座',
        'color' => '#45B7D1',
        'element' => '风象星座',
        'lucky_day' => '星期三',
        'date_range' => '5月21日-6月21日',
        'ruling_planet' => '水星',
        'personality' => '聪明、好奇、善变、沟通能力强',
        'strengths' => ['适应力强', '机智幽默', '学习能力强'],
        'weaknesses' => ['善变', '缺乏专注', '表面化']
    ],
    'cancer' => [
        'name' => '巨蟹座',
        'color' => '#FFBE0B',
        'element' => '水象星座',
        'lucky_day' => '星期一',
        'date_range' => '6月22日-7月22日',
        'ruling_planet' => '月亮',
        'personality' => '情感丰富、保护欲强、敏感、家庭导向',
        'strengths' => ['忠诚', '有同情心', '直觉敏锐'],
        'weaknesses' => ['情绪化', '过度敏感', '怀旧']
    ],
    'leo' => [
        'name' => '狮子座',
        'color' => '#FB5607',
        'element' => '火象星座',
        'lucky_day' => '星期日',
        'date_range' => '7月23日-8月22日',
        'ruling_planet' => '太阳',
        'personality' => '自信、慷慨、有领导力、喜欢被关注',
        'strengths' => ['创造力强', '热情大方', '领导才能'],
        'weaknesses' => ['傲慢', '自我中心', '爱炫耀']
    ],
    'virgo' => [
        'name' => '处女座',
        'color' => '#83C5BE',
        'element' => '土象星座',
        'lucky_day' => '星期三',
        'date_range' => '8月23日-9月22日',
        'ruling_planet' => '水星',
        'personality' => '细心、分析力强、完美主义、务实',
        'strengths' => ['认真负责', '分析能力强', '乐于助人'],
        'weaknesses' => ['挑剔', '过分批判', '焦虑']
    ],
    'libra' => [
        'name' => '天秤座',
        'color' => '#FFDDD2',
        'element' => '风象星座',
        'lucky_day' => '星期五',
        'date_range' => '9月23日-10月23日',
        'ruling_planet' => '金星',
        'personality' => '和谐、公正、优雅、社交能力强',
        'strengths' => ['外交手腕', '追求和平', '审美观强'],
        'weaknesses' => ['犹豫不决', '回避冲突', '肤浅']
    ],
    'scorpio' => [
        'name' => '天蝎座',
        'color' => '#E29578',
        'element' => '水象星座',
        'lucky_day' => '星期二',
        'date_range' => '10月24日-11月22日',
        'ruling_planet' => '冥王星',
        'personality' => '热情、神秘、意志坚强、有洞察力',
        'strengths' => ['意志坚定', '有洞察力', '充满激情'],
        'weaknesses' => ['嫉妒心强', '记仇', '极端']
    ],
    'sagittarius' => [
        'name' => '射手座',
        'color' => '#FF006E',
        'element' => '火象星座',
        'lucky_day' => '星期四',
        'date_range' => '11月23日-12月21日',
        'ruling_planet' => '木星',
        'personality' => '乐观、爱自由、诚实、爱冒险',
        'strengths' => ['乐观开朗', '诚实直率', '思想开放'],
        'weaknesses' => ['不负责任', '过度乐观', '不切实际']
    ],
    'capricorn' => [
        'name' => '摩羯座',
        'color' => '#3A86FF',
        'element' => '土象星座',
        'lucky_day' => '星期六',
        'date_range' => '12月22日-1月19日',
        'ruling_planet' => '土星',
        'personality' => '负责、有野心、自律、务实',
        'strengths' => ['有责任感', '自律', '实际'],
        'weaknesses' => ['悲观', '固执', '工作狂']
    ],
    'aquarius' => [
        'name' => '水瓶座',
        'color' => '#8338EC',
        'element' => '风象星座',
        'lucky_day' => '星期六',
        'date_range' => '1月20日-2月18日',
        'ruling_planet' => '天王星',
        'personality' => '创新、独立、人道主义、思想先进',
        'strengths' => ['进步思想', '人道主义','独立自主'],
        'weaknesses' => ['叛逆', '冷漠', '不切实际']
    ],
    'pisces' => [
        'name' => '双鱼座',
        'color' => '#00BBF9',
        'element' => '水象星座',
        'lucky_day' => '星期四',
        'date_range' => '2月19日-3月20日',
        'ruling_planet' => '海王星',
        'personality' => '同情心强、直觉敏锐、艺术气质、浪漫',
        'strengths' => ['有同情心', '艺术气质', '直觉敏锐'],
        'weaknesses' => ['逃避现实', '容易受骗', '意志薄弱']
    ]
];

// 严谨化内容库
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
        $numbers = [
            1, 2, 3, 4, 5, 6, 7, 9, 11, 13,  
            15, 17, 18, 19, 20, 21, 22, 25, 27, 29,  
            31, 33, 35, 36, 43, 48, 52, 55, 66, 69,  
            70, 72, 81, 88, 99, 100  
        ];
        return $numbers[array_rand($numbers)];
    }

    public static function getLuckyColor() {
        $colors = [
            '古典红' => '#9A1F1A',      // 浓郁的传统红色  
            '孔雀蓝' => '#0047AB',      // 鲜艳的深蓝色  
            '翡翠绿' => '#2C5545',      // 深沉的绿色  
            '帝王紫' => '#5D3FD3',      // 高贵的紫色  
            '香槟金' => '#F0E68C',      // 柔和的淡金色  
            '月光银' => '#C0C0C0',      // 经典银色  
            '樱花粉' => '#FFB7C5',      // 温柔的粉色  
            '落日橙' => '#FF7F50',      // 温暖的橙红色  
            '星空蓝' => '#1E3F66',      // 深邃的夜空蓝  
            '薄荷绿' => '#3EB489',      // 清新的蓝绿色  
            '玫瑰金' => '#E0BFB8',      // 浪漫的玫瑰金色  
            '松柏绿' => '#01796F',      // 沉稳的深绿色  
            '琥珀黄' => '#FFBF00',      // 明亮的金黄色  
            '珊瑚红' => '#FF4040',      // 鲜艳的红色  
            '薰衣草紫' => '#B57EDC',     // 柔和的淡紫色  
            '深海蓝' => '#003366',      // 暗沉的深蓝色  
            '奶油白' => '#FFFDD0',      // 温暖的米白色  
            '咖啡棕' => '#6F4E37',      // 经典的棕色  
            '柠檬黄' => '#FFF44F',      // 明亮的黄色  
            '宝石红' => '#CC0000',      // 鲜艳的正红色  
            '天青色' => '#4F97A3',      // 淡雅的蓝绿色  
            '巧克力棕' => '#7B3F00',    // 浓郁的深棕色  
            '冰晶蓝' => '#ADD8E6',      // 浅淡的蓝色  
            '橄榄绿' => '#808000',      // 自然的军绿色  
        ];
        $name = array_rand($colors);
        return ['name' => $name, 'hex' => $colors[$name]];
    }

    public static function getLuckyTime() {
        $times = [
            '深夜时段 (00:00-02:00)',  
            '凌晨时段 (03:00-05:00)',  
            '清晨时段 (06:00-08:00)',  
            '上午时段 (09:00-11:00)',  
            '午间时段 (12:00-14:00)',  
            '午后时段 (13:00-15:00)',  
            '下午时段 (15:00-17:00)',  
            '傍晚时段 (17:00-19:00)',  
            '晚间时段 (19:00-21:00)',  
            '夜间时段 (21:00-23:00)',  
            '午夜时段 (23:00-01:00)',  
            '夜晨交接时段 (02:00-04:00)'  
        ];
        return $times[array_rand($times)];
    }

    public static function getAdvice($category) {
        $advices = [
            'health' => [
                '保持规律作息时间（7-8小时睡眠最佳）',
                '每周至少3次有氧运动（如跑步、游泳）',
                '饮食多样化，确保蛋白质+膳食纤维摄入',
                '每天喝够2L水，少量多次饮用',
                '每工作1小时起身活动5分钟',
                '每年做一次全面体检',
                '减少精制糖和油炸食品摄入',
                '学习正念冥想缓解压力',
                '保证每日15分钟日光浴（促进维生素D合成）',
                '睡前1小时避免使用电子设备',
                '保持正确坐姿/站姿（预防脊椎问题）',
                '培养至少1项可持续的户外爱好'
            ],
            'love' => [
                '每天至少一次真诚的赞美',
                '每周安排2-3次专属「无手机时间」',
                '共同制定未来3个月的共同目标',
                '定期体验新事物（如旅行、课程）',
                '建立「矛盾解决」的固定沟通方式',
                '保留个人空间（健康关系需要适度距离）',
                '重要日期用心准备小惊喜',
                '睡前10分钟分享当日感受',
                '学习「非暴力沟通」技巧',
                '共同承担家务（培养责任感）',
                '每年拍摄一次情侣写真（记录成长）',
                '定期回顾初遇时的美好记忆'
            ],
            'career' => [
                '使用SMART原则制定季度目标',
                '每天先完成最难的任务（吃青蛙法则）',
                '建立职业发展人脉网络',
                '每月学习1项新技能（哪怕很小）',
                '优化工作环境（灯光/座椅/噪音控制）',
                '定期向上级汇报进展（增加能见度）',
                '用番茄工作法提升专注力',
                '建立「成就清单」记录成功案例',
                '分析行业Top3人物的成长路径',
                '每年更新简历（即使不跳槽）',
                '参与跨部门项目扩大视野',
                '设定工作与生活的物理分界线（如下班仪式）'
            ]
        ];
        return $advices[$category][array_rand($advices[$category])];
    }

    // 新增方法：生成详细分析描述
    public static function getDetailedAnalysis($category, $score, $signInfo) {
        $templates = [
            'health' => [
                [90, 100, "今日{name}的健康运势极佳！你的活力充沛，免疫系统处于最佳状态。{element}的特质让你{traits}，建议继续保持良好的作息习惯。"],
                [75, 89, "今日{name}的健康状况良好，身体各项机能运转正常。作为{personality}的星座，你需要注意{weakness}，但总体健康无忧。"],
                [60, 74, "今日{name}的健康运势中等，可能存在轻微疲劳感。{element}的你需要特别注意{health_tip}，适当调整生活节奏。"],
                [0, 59, "今日{name}需要特别关注健康问题。受{planet}影响，你容易感到{weakness}，建议及时休息并寻求专业建议。"]
            ],
            'love' => [
                [90, 100, "今日{name}的感情运势极佳！单身者有机会遇到心仪对象，有伴侣者关系更加亲密。{element}特质让你在感情中{traits}。"],
                [75, 89, "今日{name}的感情发展稳定，沟通顺畅。作为{personality}的星座，你可以尝试{love_tip}来增进感情。"],
                [60, 74, "今日{name}的感情运势一般，可能存在一些小摩擦。{element}的你需要避免{weakness}，多些包容理解。"],
                [0, 59, "今日{name}的感情面临挑战。受{planet}影响，容易产生误会，建议冷静沟通，避免情绪化决定。"]
            ],
            'career' => [
                [90, 100, "今日{name}的事业运势极佳！工作表现突出，容易获得认可。{element}特质让你在职场上{traits}，抓住机会展现自己。"],
                [75, 89, "今日{name}的工作推进顺利，项目进展有序。作为{personality}的星座，你可以{career_tip}来提升职业发展。"],
                [60, 74, "今日{name}的事业运势平稳，可能遇到一些挑战。{element}的你需要克服{weakness}，保持专注和耐心。"],
                [0, 59, "今日{name}的工作压力较大。受{planet}影响，容易感到疲惫，建议合理分配任务，寻求同事支持。"]
            ]
        ];

        $health_tips = ['规律作息', '均衡饮食', '适度运动', '压力管理'];
        $love_tips = ['浪漫约会', '真诚沟通', '制造惊喜', '共同成长'];
        $career_tips = ['学习新技能', '拓展人脉', '设定目标', '时间管理'];

        foreach ($templates[$category] as $template) {
            if ($score >= $template[0] && $score <= $template[1]) {
                $analysis = $template[2];
                $analysis = str_replace('{name}', $signInfo['name'], $analysis);
                $analysis = str_replace('{element}', $signInfo['element'], $analysis);
                $analysis = str_replace('{personality}', $signInfo['personality'], $analysis);
                $analysis = str_replace('{planet}', $signInfo['ruling_planet'], $analysis);
                $analysis = str_replace('{traits}', self::getElementTraits($signInfo['element']), $analysis);
                $analysis = str_replace('{weakness}', $signInfo['weaknesses'][array_rand($signInfo['weaknesses'])], $analysis);
                $analysis = str_replace('{health_tip}', $health_tips[array_rand($health_tips)], $analysis);
                $analysis = str_replace('{love_tip}', $love_tips[array_rand($love_tips)], $analysis);
                $analysis = str_replace('{career_tip}', $career_tips[array_rand($career_tips)], $analysis);
                
                return $analysis;
            }
        }
        
        return "今日运势平稳，保持积极心态面对生活。";
    }

    // 新增方法：生成星座今日总评
    public static function getDailySummary($signInfo, $overallScore, $scores) {
        $summaries = [
            [90, 100, [
                "今天是{name}的幸运日！各方面运势都非常出色，{element}能量充沛。你的{strength}将得到充分发挥，抓住机会实现目标。",
                "完美的一天！{name}今日运势爆棚，{personality}的特质让你在各方面都表现出色。好好利用这股正能量。",
                "吉星高照！{name}今天在健康、感情、事业三方面都获得高分，{planet}为你带来好运和机遇。"
            ]],
            [75, 89, [
                "今天{name}运势良好，{element}特质让你{traits}。虽然有小挑战，但你的{strength}足以应对。",
                "平稳顺利的一天！{name}各方面表现稳定，{personality}的性格优势让你游刃有余。",
                "运势不错！{name}今天在{planet}的影响下，展现出{strength}，整体表现令人满意。"
            ]],
            [60, 74, [
                "今天{name}运势中等，需要留意{weakness}。但{element}的韧性让你能够克服困难，保持积极心态。",
                "稍有波折的一天。{name}可能会遇到一些小挑战，但你的{strength}能够帮助你平稳度过。",
                "运势平稳。{name}今天在{planet}影响下，需要更多耐心，但总体趋势向好发展。"
            ]],
            [0, 59, [
                "今天{name}需要格外注意，运势相对低迷。避免{weakness}的影响，多依靠{strength}来应对挑战。",
                "挑战较多的一天。{name}可能会感到压力，但记住{personality}的韧性能够帮助你度过难关。",
                "运势有待提升。{name}今天在{planet}的影响下，需要更多休息和调整，保持耐心等待转机。"
            ]]
        ];

        foreach ($summaries as $summary) {
            if ($overallScore >= $summary[0] && $overallScore <= $summary[1]) {
                $text = $summary[2][array_rand($summary[2])];
                $text = str_replace('{name}', $signInfo['name'], $text);
                $text = str_replace('{element}', $signInfo['element'], $text);
                $text = str_replace('{personality}', $signInfo['personality'], $text);
                $text = str_replace('{planet}', $signInfo['ruling_planet'], $text);
                $text = str_replace('{traits}', self::getElementTraits($signInfo['element']), $text);
                $text = str_replace('{strength}', $signInfo['strengths'][array_rand($signInfo['strengths'])], $text);
                $text = str_replace('{weakness}', $signInfo['weaknesses'][array_rand($signInfo['weaknesses'])], $text);
                
                return $text;
            }
        }
        
        return "今日运势平稳，保持平常心面对生活的点点滴滴。";
    }

    // 新增方法：生成星座配对建议
    public static function getCompatibility($sign) {
        $compatibilities = [
            'aries' => ['最佳配对：狮子座、射手座', '良好配对：双子座、水瓶座', '需要注意：巨蟹座、摩羯座'],
            'taurus' => ['最佳配对：处女座、摩羯座', '良好配对：巨蟹座、双鱼座', '需要注意：狮子座、水瓶座'],
            'gemini' => ['最佳配对：天秤座、水瓶座', '良好配对：白羊座、狮子座', '需要注意：处女座、双鱼座'],
            'cancer' => ['最佳配对：天蝎座、双鱼座', '良好配对：金牛座、处女座', '需要注意：白羊座、天秤座'],
            'leo' => ['最佳配对：白羊座、射手座', '良好配对：双子座、天秤座', '需要注意：金牛座、天蝎座'],
            'virgo' => ['最佳配对：金牛座、摩羯座', '良好配对：巨蟹座、天蝎座', '需要注意：双子座、射手座'],
            'libra' => ['最佳配对：双子座、水瓶座', '良好配对：狮子座、射手座', '需要注意：巨蟹座、摩羯座'],
            'scorpio' => ['最佳配对：巨蟹座、双鱼座', '良好配对：处女座、摩羯座', '需要注意：狮子座、水瓶座'],
            'sagittarius' => ['最佳配对：白羊座、狮子座', '良好配对：天秤座、水瓶座', '需要注意：处女座、双鱼座'],
            'capricorn' => ['最佳配对：金牛座、处女座', '良好配对：天蝎座、双鱼座', '需要注意：白羊座、天秤座'],
            'aquarius' => ['最佳配对：双子座、天秤座', '良好配对：白羊座、射手座', '需要注意：金牛座、天蝎座'],
            'pisces' => ['最佳配对：巨蟹座、天蝎座', '良好配对：金牛座、摩羯座', '需要注意：双子座、射手座']
        ];
        
        return $compatibilities[$sign] ?? ['最佳配对：天秤座、水瓶座', '良好配对：白羊座、射手座', '需要注意：金牛座、天蝎座'];
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
        
        $signInfo = ZODIAC_CONFIG[$sign];
        
        $reportData = [
            'basic_info' => [
                'name' => $signInfo['name'],
                'color' => $signInfo['color'],
                'element' => $signInfo['element'],
                'date_range' => $signInfo['date_range'],
                'ruling_planet' => $signInfo['ruling_planet'],
                'personality' => $signInfo['personality'],
                'strengths' => $signInfo['strengths'],
                'weaknesses' => $signInfo['weaknesses'],
                'date' => date('Y-m-d')
            ],
            'lucky' => [
                'number' => ContentLibrary::getLuckyNumber(),
                'color' => ContentLibrary::getLuckyColor(),
                'time' => ContentLibrary::getLuckyTime(),
                'day' => $signInfo['lucky_day'],
                'compatibility' => ContentLibrary::getCompatibility($sign)
            ],
            'analysis' => [
                'health' => [
                    'score' => $scores['health'],
                    'evaluation' => ContentLibrary::getHealthEvaluation($scores['health']),
                    'advice' => ContentLibrary::getAdvice('health'),
                    'detailed_analysis' => ContentLibrary::getDetailedAnalysis('health', $scores['health'], $signInfo)
                ],
                'love' => [
                    'score' => $scores['love'],
                    'evaluation' => ContentLibrary::getLoveEvaluation($scores['love']),
                    'advice' => ContentLibrary::getAdvice('love'),
                    'detailed_analysis' => ContentLibrary::getDetailedAnalysis('love', $scores['love'], $signInfo)
                ],
                'career' => [
                    'score' => $scores['career'],
                    'evaluation' => ContentLibrary::getCareerEvaluation($scores['career']),
                    'advice' => ContentLibrary::getAdvice('career'),
                    'detailed_analysis' => ContentLibrary::getDetailedAnalysis('career', $scores['career'], $signInfo)
                ],
                'element_traits' => ContentLibrary::getElementTraits($signInfo['element']),
                'daily_summary' => ContentLibrary::getDailySummary($signInfo, $overallScore, $scores)
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
