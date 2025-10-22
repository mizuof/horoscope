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
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,15, 16, 17, 18, 19, 20, 
            21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 39, 40, 
            41, 42, 43, 45, 46, 48, 49, 50, 52, 54, 55, 56, 60, 63, 64, 66, 69 ,70, 72, 75, 77, 79, 80, 81, 
            82, 85, 88, 90, 92, 96, 99, 100  
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
                '培养至少1项可持续的户外爱好',
                '定期进行深度拉伸，改善肌肉柔韧性',
                '建立个人健康档案，记录关键指标变化',
                '学习基础的急救知识和技能',
                '避免长时间保持同一姿势，定时变换体位',
                '培养深呼吸习惯，每天进行5分钟腹式呼吸',
                '选择适合自己的补充剂（如维生素、益生菌）',
                '建立健康的社交圈，减少孤独感对健康的影响',
                '定期进行牙齿检查和口腔护理',
                '控制咖啡因和酒精摄入量',
                '培养乐观心态，积极面对生活压力'
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
                '定期回顾初遇时的美好记忆',
                '培养共同的兴趣爱好，创造更多共同话题',
                '学会主动道歉和真诚原谅',
                '定期进行深度对话，了解彼此内心变化',
                '为对方的小成就真诚庆祝',
                '保持适度的浪漫，不让爱情变成习惯',
                '学习对方的爱情语言，用ta理解的方式表达爱',
                '建立家庭传统，创造专属回忆',
                '在争吵中保持尊重，不攻击对方弱点',
                '定期评估关系满意度，及时调整相处模式',
                '给对方足够的信任和自由空间'
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
                '设定工作与生活的物理分界线（如下班仪式）',
                '建立个人知识管理系统，整理工作心得',
                '主动寻求反馈，持续改进工作表现',
                '培养跨领域思维，学习其他行业优秀实践',
                '定期参加行业会议和培训，保持前沿视野',
                '建立紧急情况应对预案，提高抗风险能力',
                '学会有效委派任务，提升团队协作效率',
                '培养公众演讲和表达技巧',
                '建立个人品牌，在专业领域建立影响力',
                '学习时间块管理法，提高时间利用效率',
                '保持职业好奇心，持续探索新的可能性'
            ]
        ];
        return $advices[$category][array_rand($advices[$category])];
    }


    public static function getDetailedAnalysis($category, $score, $signInfo) {
        $templates = [
            'health' => [
                [95, 100, [
                    "今日{name}的健康状态达到巅峰！你的精力充沛如火山喷发，免疫系统坚不可摧。{element}特质让你{traits}，所有生理指标都处于最佳状态。",
                    "{name}今日健康运势爆棚！身体状态完美无瑕，活力四射让人羡慕。{element}的能量让你{traits}，继续保持这种巅峰状态吧！",
                    "恭喜{name}！今日健康指数满分，身体机能运转如精密仪器。{personality}的特质让你{traits}，这是进行高强度锻炼的绝佳时机。"
                ]],
                [90, 94, [
                    "今日{name}的健康状态极佳！精力充沛，免疫力强大。{element}特质让你{traits}，身体状况令人羡慕。",
                    "{name}今日活力满满，健康状态非常出色。{personality}的性格让你{traits}，继续保持良好的生活习惯。",
                    "健康运势强劲！{name}今日身体状态优秀，{element}能量让你{traits}，适合尝试新的运动项目。"
                ]],
                [85, 89, [
                    "今日{name}的健康状态良好，身体各项机能运转顺畅。{element}特质让你{traits}，但要注意{weakness}的影响。",
                    "{name}今日身体状况稳定，精力充沛。{personality}的特质让你{traits}，建议{health_tip}来维持状态。",
                    "健康运势平稳向上！{name}今日状态不错，{element}能量支撑着你{traits}，继续保持规律作息。"
                ]],
                [80, 84, [
                    "今日{name}的健康状态较为稳定，但需留意轻微疲劳。{element}特质让你{traits}，建议适当休息调整。",
                    "{name}今日身体状况尚可，但{personality}的性格可能让你忽略{weakness}，需要注意{health_tip}。",
                    "健康运势中等偏上！{name}今日整体状态良好，{element}能量让你{traits}，但要避免过度劳累。"
                ]],
                [75, 79, [
                    "今日{name}的健康状态平稳，但存在一些潜在问题。{element}特质让你{traits}，建议关注{health_tip}。",
                    "{name}今日身体状况一般，{personality}的性格可能加剧{weakness}，需要特别注意休息。",
                    "健康运势有待提升！{name}今日需要更多关注身体状况，{element}能量可帮助你{traits}。"
                ]],
                [70, 74, [
                    "今日{name}的健康状态出现轻微波动，可能感到些许疲惫。{element}特质让你{traits}，但要避免{weakness}的影响。",
                    "{name}今日需要更多休息，身体状况略显疲惫。{personality}的性格可能让你忽视健康信号，建议{health_tip}。",
                    "健康运势中等偏下！{name}今日状态不佳，{element}能量被压制，需要调整生活节奏。"
                ]],
                [60, 69, [
                    "今日{name}的健康状态需要关注，可能存在亚健康问题。{element}特质让你{traits}，但受{planet}影响，容易{weakness}。",
                    "{name}今日身体状况欠佳，{personality}的性格可能让你忽略健康警告，急需{health_tip}。",
                    "健康运势预警！{name}今日状态低迷，{element}能量受阻，建议及时调整生活方式。"
                ]],
                [50, 59, [
                    "今日{name}的健康状态较差，需要立即采取措施。{element}特质让你{traits}，但{weakness}问题突出，建议寻求专业帮助。",
                    "{name}今日健康状况令人担忧，{personality}的性格可能加剧问题，必须重视{health_tip}。",
                    "健康危机信号！{name}今日状态严重下滑，{element}能量无法发挥，急需医疗关注。"
                ]],
                [0, 49, [
                    "今日{name}的健康状态极度危险！立即停止所有工作，专注于健康恢复。{element}特质完全被{weakness}压制，必须就医。",
                    "{name}今日健康红灯全亮！{personality}的性格让你忽视严重问题，立即{health_tip}并寻求专业医疗帮助。",
                    "健康紧急状态！{name}今日面临严重健康威胁，{element}能量完全失效，生命安全受到威胁。"
                ]]
            ],
            'love' => [
                [95, 100, [
                    "今日{name}的爱情运势达到巅峰！单身者桃花运爆棚，有伴侣者感情如胶似漆。{element}特质让你{traits}，感情生活完美无瑕。",
                    "{name}今日爱情运势满分！浪漫气息弥漫四周，所有感情问题迎刃而解。{personality}的特质让你{traits}，尽情享受爱的美好吧！",
                    "爱情运势登顶！{name}今日在感情世界中如鱼得水，{element}能量让你{traits}，这是表白或求婚的绝佳时机。"
                ]],
                [90, 94, [
                    "今日{name}的爱情运势极佳！感情生活丰富多彩，亲密关系更加深厚。{element}特质让你{traits}，爱情甜蜜度爆表。",
                    "{name}今日感情运势强劲，单身者容易遇到理想对象，有伴侣者关系更加稳固。{personality}的特质让你{traits}。",
                    "爱情运势优秀！{name}今日在感情中游刃有余，{element}能量让你{traits}，适合策划浪漫约会。"
                ]],
                [85, 89, [
                    "今日{name}的爱情运势良好，感情发展顺利。{element}特质让你{traits}，但要注意{weakness}对感情的影响。",
                    "{name}今日感情状态稳定，沟通顺畅。{personality}的性格让你{traits}，建议{love_tip}来增进感情。",
                    "爱情运势平稳向上！{name}今日感情生活和谐，{element}能量支撑着你{traits}，继续保持良好互动。"
                ]],
                [80, 84, [
                    "今日{name}的爱情运势较为稳定，但需留意小摩擦。{element}特质让你{traits}，建议多些包容理解。",
                    "{name}今日感情发展尚可，但{personality}的性格可能让你{weakness}，需要注意沟通方式。",
                    "爱情运势中等偏上！{name}今日整体感情良好，{element}能量让你{traits}，但要避免情绪化。"
                ]],
                [75, 79, [
                    "今日{name}的爱情运势平稳，但存在一些沟通障碍。{element}特质让你{traits}，建议{love_tip}来改善关系。",
                    "{name}今日感情状态一般，{personality}的性格可能加剧{weakness}，需要更多耐心和理解。",
                    "爱情运势有待提升！{name}今日需要更多情感投入，{element}能量可帮助你{traits}。"
                ]],
                [70, 74, [
                    "今日{name}的爱情运势出现波动，可能有些小矛盾。{element}特质让你{traits}，但要避免{weakness}的影响。",
                    "{name}今日需要更多沟通，感情状态略显紧张。{personality}的性格可能让你误解对方意图，建议{love_tip}。",
                    "爱情运势中等偏下！{name}今日感情不佳，{element}能量被压制，需要主动化解矛盾。"
                ]],
                [60, 69, [
                    "今日{name}的爱情运势需要关注，可能存在较大分歧。{element}特质让你{traits}，但受{planet}影响，容易{weakness}。",
                    "{name}今日感情状态欠佳，{personality}的性格可能让你固执己见，急需{love_tip}来修复关系。",
                    "爱情运势预警！{name}今日感情低迷，{element}能量受阻，建议冷静沟通避免冲突升级。"
                ]],
                [50, 59, [
                    "今日{name}的爱情运势较差，关系面临考验。{element}特质让你{traits}，但{weakness}问题严重，需要专业情感指导。",
                    "{name}今日感情状况令人担忧，{personality}的性格可能加剧矛盾，必须重视{love_tip}。",
                    "感情危机信号！{name}今日关系严重下滑，{element}能量无法发挥，急需深度沟通和妥协。"
                ]],
                [0, 49, [
                    "今日{name}的爱情运势极度危险！感情关系濒临破裂，立即采取挽救措施。{element}特质完全被{weakness}压制。",
                    "{name}今日感情红灯全亮！{personality}的性格让你无法理性处理问题，立即{love_tip}并寻求专业帮助。",
                    "感情紧急状态！{name}今日面临关系崩溃威胁，{element}能量完全失效，需要紧急情感干预。"
                ]]
            ],
            'career' => [
                [95, 100, [
                    "今日{name}的事业运势达到巅峰！工作表现卓越，职业机遇接踵而至。{element}特质让你{traits}，职业生涯迎来重大突破。",
                    "{name}今日事业运势满分！才华得到充分展现，所有工作难题迎刃而解。{personality}的特质让你{traits}，抓住这个黄金时期大展宏图！",
                    "事业运势登顶！{name}今日在职场上如日中天，{element}能量让你{traits}，这是升职加薪的绝佳机会。"
                ]],
                [90, 94, [
                    "今日{name}的事业运势极佳！工作推进顺利，专业能力获得认可。{element}特质让你{traits}，职场表现令人瞩目。",
                    "{name}今日职业发展强劲，项目进展神速，团队协作顺畅。{personality}的特质让你{traits}，继续展现领导才能。",
                    "事业运势优秀！{name}今日工作状态完美，{element}能量让你{traits}，适合挑战重要任务。"
                ]],
                [85, 89, [
                    "今日{name}的事业运势良好，工作进展顺利。{element}特质让你{traits}，但要注意{weakness}对工作的影响。",
                    "{name}今日工作状态稳定，效率较高。{personality}的性格让你{traits}，建议{career_tip}来提升表现。",
                    "事业运势平稳向上！{name}今日职场表现不错，{element}能量支撑着你{traits}，继续保持专业态度。"
                ]],
                [80, 84, [
                    "今日{name}的事业运势较为稳定，但需留意细节问题。{element}特质让你{traits}，建议{career_tip}来优化工作流程。",
                    "{name}今日工作进展尚可，但{personality}的性格可能让你{weakness}，需要注意时间管理。",
                    "事业运势中等偏上！{name}今日整体工作良好，{element}能量让你{traits}，但要避免粗心大意。"
                ]],
                [75, 79, [
                    "今日{name}的事业运势平稳，但存在一些挑战。{element}特质让你{traits}，建议{career_tip}来克服困难。",
                    "{name}今日工作状态一般，{personality}的性格可能加剧{weakness}，需要更多专注和努力。",
                    "事业运势有待提升！{name}今日需要更多职业规划，{element}能量可帮助你{traits}。"
                ]],
                [70, 74, [
                    "今日{name}的事业运势出现波动，可能遇到阻力。{element}特质让你{traits}，但要避免{weakness}的影响。",
                    "{name}今日需要更多耐心，工作进展略显缓慢。{personality}的性格可能让你冲动决策，建议{career_tip}。",
                    "事业运势中等偏下！{name}今日工作不佳，{element}能量被压制，需要调整策略和方法。"
                ]],
                [60, 69, [
                    "今日{name}的事业运势需要关注，可能存在较大困难。{element}特质让你{traits}，但受{planet}影响，容易{weakness}。",
                    "{name}今日工作状态欠佳，{personality}的性格可能让你失去方向，急需{career_tip}来扭转局面。",
                    "事业运势预警！{name}今日职业发展受阻，{element}能量受阻，建议寻求同事支持和指导。"
                ]],
                [50, 59, [
                    "今日{name}的事业运势较差，工作面临危机。{element}特质让你{traits}，但{weakness}问题严重，需要紧急调整策略。",
                    "{name}今日工作状况令人担忧，{personality}的性格可能加剧问题，必须重视{career_tip}。",
                    "职业危机信号！{name}今日工作表现严重下滑，{element}能量无法发挥，急需专业指导和帮助。"
                ]],
                [0, 49, [
                    "今日{name}的事业运势极度危险！职业生涯面临重大挑战，立即采取挽救措施。{element}特质完全被{weakness}压制。",
                    "{name}今日事业红灯全亮！{personality}的性格让你无法有效工作，立即{career_tip}并寻求专业指导。",
                    "职业紧急状态！{name}今日面临失业威胁，{element}能量完全失效，需要紧急职业转型规划。"
                ]]
            ]
        ];

        $health_tips = ['规律作息', '均衡饮食', '适度运动', '压力管理', '充足睡眠', '定期体检'];
        $love_tips = ['浪漫约会', '真诚沟通', '制造惊喜', '共同成长', '深度交流', '相互理解'];
        $career_tips = ['学习新技能', '拓展人脉', '设定目标', '时间管理', '提升效率', '团队协作'];
    
        foreach ($templates[$category] as $template) {
            if ($score >= $template[0] && $score <= $template[1]) {
                $templateOptions = $template[2];
                $selectedTemplate = $templateOptions[array_rand($templateOptions)];
                
                $analysis = $selectedTemplate;
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

public static function getDailySummary($signInfo, $overallScore, $scores) {
    $summaries = [
        [95, 100, [
            "今日{name}运势登峰造极！天时地利人和齐聚，{element}能量达到巅峰状态。你的{strength}得到完美展现，所有目标都能顺利达成，这是实现梦想的绝佳时机！",
            "{name}今日迎来年度最佳运势！吉星高照，万事顺遂。{personality}的特质让你{traits}，无论是事业突破还是感情发展都水到渠成。",
            "运势满分！{name}今日仿佛拥有超能力，{element}特质让你{traits}。{planet}的加持让你在各方面都表现出色，抓住这个黄金机会大展宏图！"
        ]],
        [90, 94, [
            "今日{name}运势极佳！各方面表现优异，{element}能量充沛。你的{strength}得到充分发挥，机会接踵而至，主动出击必有所获。",
            "{name}今日运势强劲！正能量满满，{personality}的优势让你{traits}。工作生活双丰收，感情甜蜜事业顺，是值得庆祝的一天。",
            "运势优秀！{name}今日在{planet}的影响下状态极佳，{element}特质让你{traits}。抓住机遇，你的努力将获得丰厚回报。"
        ]],
        [85, 89, [
            "今日{name}运势良好！整体状态稳定向上，{element}能量支撑着你{traits}。虽然偶有小挑战，但你的{strength}足以轻松应对。",
            "{name}今日运势平稳向上！{personality}的特质让你{traits}，各方面进展顺利。保持当前节奏，持续努力必见成效。",
            "运势不错！{name}今日在{planet}的关照下表现良好，{element}能量让你{traits}。继续发挥优势，稳步前进。"
        ]],
        [80, 84, [
            "今日{name}运势较为稳定！{element}特质让你{traits}，但需留意{weakness}的影响。整体趋势向好，保持信心继续努力。",
            "{name}今日运势中等偏上！{personality}的性格让你{traits}，虽然有些小波折，但你的{strength}能够化解困难。",
            "运势尚可！{name}今日在{planet}的影响下表现稳定，{element}能量支撑着你克服挑战。坚持就是胜利。"
        ]],
        [75, 79, [
            "今日{name}运势平稳！{element}能量让你{traits}，但{weakness}可能带来一些困扰。需要更多耐心和策略来应对挑战。",
            "{name}今日运势有待提升！{personality}的特质让你{traits}，但面对困难时容易{weakness}。调整心态，发挥{strength}。",
            "运势一般！{name}今日在{planet}的影响下表现平稳，{element}特质让你{traits}。需要更多努力来突破现状。"
        ]],
        [70, 74, [
            "今日{name}运势出现波动！{element}能量被{weakness}压制，需要格外注意。但你的{strength}依然可以帮助你度过难关。",
            "{name}今日运势中等偏下！{personality}的性格可能加剧{weakness}，导致进展受阻。需要调整策略，寻求支持。",
            "运势稍有挑战！{name}今日在{planet}的影响下面临阻力，{element}特质难以发挥。保持冷静，寻找突破口。"
        ]],
        [65, 69, [
            "今日{name}运势需要关注！{element}能量受阻，{weakness}问题凸显。需要立即采取措施，避免情况恶化。",
            "{name}今日运势面临考验！{personality}的特质可能让你{weakness}，导致决策失误。需要谨慎行事，三思后行。",
            "运势预警！{name}今日在{planet}的负面影响下面临挑战，{element}能量难以支撑。急需调整方向和策略。"
        ]],
        [60, 64, [
            "今日{name}运势低迷！{element}特质被{weakness}完全压制，各方面进展缓慢。需要重新规划，寻求外部帮助。",
            "{name}今日运势较差！{personality}的性格缺陷暴露无遗，导致问题频发。必须正视现实，积极改变。",
            "运势不佳！{name}今日在{planet}的负面影响下举步维艰，{element}能量无法发挥作用。需要彻底反思和调整。"
        ]],
        [55, 59, [
            "今日{name}运势严峻！{element}能量几乎消失，{weakness}问题严重。需要立即止损，避免更大损失。",
            "{name}今日运势危机四伏！{personality}的负面特质全面爆发，导致局面失控。必须寻求专业指导和帮助。",
            "运势危险！{name}今日在{planet}的强烈负面影响下面临重大挑战，{element}特质完全失效。需要紧急应对措施。"
        ]],
        [50, 54, [
            "今日{name}运势极度危险！{element}能量完全被{weakness}压制，各方面都面临严重问题。立即停止所有行动，专注危机处理。",
            "{name}今日运势濒临崩溃！{personality}的缺陷导致全面失败，关系破裂、事业受阻。必须彻底改变策略。",
            "运势紧急状态！{name}今日在{planet}的毁灭性影响下面临生存危机，{element}特质荡然无存。需要立即寻求专业救助。"
        ]],
        [40, 49, [
            "今日{name}运势灾难性下滑！{element}能量完全消失，{weakness}问题达到顶点。所有计划都需要重新评估，生存成为首要任务。",
            "{name}今日运势全面崩溃！{personality}的负面特质引发连锁反应，导致无法挽回的损失。必须接受现实，重新开始。",
            "运势彻底失败！{name}今日在{planet}的极端负面影响下失去所有优势，{element}特质完全无效。需要彻底转型和重建。"
        ]],
        [0, 39, [
            "今日{name}运势跌入谷底！这是最黑暗的时刻，{element}能量完全枯竭，{weakness}问题无法控制。但请记住，触底必将反弹。",
            "{name}今日运势极度危机！{personality}的缺陷导致全面崩溃，所有努力付之东流。这是重新认识自我、彻底改变的契机。",
            "运势绝对低谷！{name}今日在{planet}的毁灭性打击下失去一切，{element}特质完全失效。但黎明前的黑暗最深沉，坚持就是胜利。"
        ]]
    ];

    foreach ($summaries as $summary) {
        if ($overallScore >= $summary[0] && $overallScore <= $summary[1]) {
            $templateOptions = $summary[2];
            $selectedTemplate = $templateOptions[array_rand($templateOptions)];
            
            $text = $selectedTemplate;
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
