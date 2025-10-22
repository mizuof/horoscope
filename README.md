# Mizu 星座运势 / Mizu Horoscope

<div align="center">

![Version](https://img.shields.io/badge/Version-5.0_beta-blue)
![License](https://img.shields.io/badge/License-MIT-green)

**语言切换 / Language Switch**  
[中文](#中文) | [English](#english)

</div>

---

## 中文

### Mizu 星座运势

欢迎使用 Mizu 星座运势，一款集美观与实用性于一体的星座应用。无论您是想了解每日运势，还是探索更深层次的星座特质，Mizu 都能为您提供个性化的星座解读。

### 主要功能

#### 🎨 视觉享受
- **动态星空背景**：采用先进的 Three.js 技术，实时渲染出逼真的星空效果，让您仿佛置身于浩瀚宇宙中
- **互动星盘**：通过旋转星盘，您可以轻松查看不同星座的详细信息，星盘设计精美且富有科技感
- **动态色彩主题**：根据您选择的星座，应用会自动调整界面色调，营造独特的视觉氛围
- **流畅动画效果**：所有界面元素均采用平滑的过渡动画，确保操作的流畅性和视觉上的舒适感
- **粒子背景效果**：使用粒子效果模拟星空的动态感，为应用增添一份灵动与活力

#### 📱 响应式设计
- **多平台兼容**：无论您使用的是智能手机、平板还是桌面电脑，Mizu 都能完美适配，提供一致的用户体验
- **触控优化**：针对触控设备进行了专门优化，确保在移动设备上也能获得流畅的交互体验
- **智能滚动处理**：隐藏默认滚动条，同时保留顺畅的滚动功能，保持界面的简洁与美观

#### 🔮 星座运势解读
- **全面星座信息**：提供12星座的详细运势解读，涵盖健康、爱情、事业等多个方面
- **个性化数据**：包括幸运数字、幸运颜色、幸运时段等个性化信息，帮助您更好地了解自身运势
- **实时数据更新**：内置数据缓存机制，减少不必要的网络请求，提升加载速度，确保您随时获取最新资讯
- **详细分析报告**：提供每个星座的深度分析，包括性格特点、优势劣势、配对建议等

#### ✨ 设计亮点
- **微互动设计**：通过细腻的交互设计，如点击按钮时的触觉反馈，增强使用乐趣
- **动态数据展示**：采用数字增长动画，让用户更直观地感受到运势的变化
- **进度条动画**：以动态的进度条形式展示星座特征，增添趣味性和可读性

### 技术实现

#### 🛠️ 技术栈
- **前端技术**：采用纯 HTML、CSS 和 JavaScript 开发，确保应用的高性能和跨平台兼容性
- **图形渲染**：使用 Three.js 实现星空背景的实时渲染
- **粒子效果**：借助 particles.js 实现细腻的粒子动画效果
- **图标字体**：使用 iconfont 和 Font Awesome 提供高质量的图标支持
- **动画效果**：结合 CSS 动画和 JavaScript 动画，实现复杂而流畅的界面过渡
- **API 集成**：通过 PHP 后端 API 获取实时星座数据

### 使用指南

#### 🌐 在线体验
您可以通过以下链接直接访问在线版本：[Mizu 星座运势在线体验](https://xz.mizu7.top)

#### 💻 本地运行

**环境要求**：
- 支持 PHP 的 Web 服务器 (Apache/Nginx)
- 现代浏览器 (支持 WebGL)
- 网络连接 (用于加载外部资源)

**部署步骤**：

1. **克隆仓库**：
   ```bash
   git clone https://github.com/mizuof/mizu-horoscope.git
   cd mizu-horoscope
   ```

2. **配置Web服务器**：
   - 将项目文件放置在Web服务器根目录
   - 确保服务器支持PHP
   - 配置URL重写（如需要）

3. **访问应用**：
   - 在浏览器中打开 `http://your-domain.com`

#### 📁 文件结构
```
mizu-horoscope/
├── index.html              # 主页面文件
├── api/
│   └── horoscope.php      # 运势数据API
├── css/
│   └── (样式文件)
├── js/
│   └── (JavaScript文件)
├── assets/
│   └── (图片和资源)
└── README.md
```

### API 说明

#### 运势数据接口

**端点**: `GET /api/horoscope.php`

**参数**:
- `sign` (必需): 星座标识符 (如: aries, taurus, gemini等)

**响应示例**:
```json
{
  "basic_info": {
    "name": "白羊座",
    "color": "#FF6B6B",
    "element": "火象星座",
    "date_range": "3月21日-4月19日",
    "ruling_planet": "火星",
    "personality": "勇敢、热情、冲动、领导力强",
    "strengths": ["行动力强", "充满激情", "直率坦诚"],
    "weaknesses": ["急躁", "缺乏耐心", "容易冲动"],
    "date": "2024-01-15"
  },
  "lucky": {
    "number": 7,
    "color": {"name": "古典红", "hex": "#9A1F1A"},
    "time": "下午时段 (15:00-17:00)",
    "day": "星期二",
    "compatibility": ["最佳配对：狮子座、射手座", "良好配对：双子座、水瓶座", "需要注意：巨蟹座、摩羯座"]
  },
  "analysis": {
    "health": {
      "score": 85,
      "evaluation": "健康状况良好",
      "advice": "保持规律作息时间",
      "detailed_analysis": "今日白羊座的健康运势良好..."
    },
    "love": {
      "score": 78,
      "evaluation": "感情发展稳定",
      "advice": "每天至少一次真诚的赞美",
      "detailed_analysis": "感情方面今日较为平稳..."
    },
    "career": {
      "score": 92,
      "evaluation": "事业发展顺利",
      "advice": "使用SMART原则制定季度目标",
      "detailed_analysis": "事业运势极佳，工作表现突出..."
    },
    "element_traits": "行动力强且富有领导力",
    "daily_summary": "今天是白羊座的幸运日！各方面运势都非常出色..."
  },
  "overall_score": 85,
  "updated_at": "2024-01-15 14:30:00"
}
```

### 自定义配置

#### 修改星座配置

在 `index.html` 中的 `ZODIAC_CONFIG` 数组可以自定义星座信息：

```javascript
const ZODIAC_CONFIG = [
  { 
    id: 'aries', 
    name: '白羊座', 
    icon: 'icon-baiyang', 
    angle: 0, 
    color: '#FF6B6B' 
  },
  // ... 其他星座配置
];
```

#### 调整主题颜色

修改CSS变量来改变整体主题：

```css
:root {
  --primary: #8b5cf6;      /* 主色调 */
  --secondary: #6366f1;    /* 辅助色 */
  --background: #0f172a;   /* 背景色 */
  --text: #f8fafc;         /* 文字色 */
  --accent: #f59e0b;       /* 强调色 */
}
```

### 浏览器兼容性

| 浏览器 | 版本 | 支持情况 |
|--------|------|----------|
| Chrome | 60+  | ✅ 完全支持 |
| Firefox | 55+ | ✅ 完全支持 |
| Safari | 12+ | ✅ 完全支持 |
| Edge | 79+ | ✅ 完全支持 |
| iOS Safari | 12+ | ✅ 完全支持 |

### 开发计划

- [ ] 添加用户登录和收藏功能
- [ ] 实现周运势和月运势
- [ ] 添加星座配对分析
- [ ] 开发移动端APP
- [ ] 多语言支持

### 贡献指南

我们欢迎各种形式的贡献！

1. Fork 本项目
2. 创建功能分支 (`git checkout -b feature/AmazingFeature`)
3. 提交更改 (`git commit -m 'Add some AmazingFeature'`)
4. 推送到分支 (`git push origin feature/AmazingFeature`)
5. 开启 Pull Request

### 许可证

本项目采用 MIT 许可证 - 查看 [LICENSE](LICENSE) 文件了解详情。

### 更新日志

#### v5.0
- 适配新版API数据结构
- 新增详细分析模块
- 优化移动端体验
- 改进视觉设计

#### v4.7.5
- 添加星座配对建议
- 改进缓存机制
- 性能优化

### 技术支持

如有问题或建议，请通过以下方式联系：

- 提交 [Issue](https://github.com/mizuof/mizu-horoscope/issues)
- 发送邮件至: support@mizu7.top

---

**免责声明**: 本应用提供的星座运势内容仅供娱乐参考，不作为专业建议。

---

## English

### Mizu Horoscope

Welcome to Mizu Horoscope, a beautiful and practical zodiac application. Whether you want to know your daily horoscope or explore deeper zodiac traits, Mizu provides personalized zodiac interpretations for you.

### Key Features

#### 🎨 Visual Experience
- **Dynamic Starry Background**: Utilizing advanced Three.js technology, the app renders a realistic starry sky, making you feel as if you are in the vast universe
- **Interactive Star Wheel**: Rotate the star wheel to view detailed information about different zodiac signs. The design is both beautiful and futuristic
- **Dynamic Color Themes**: The app automatically adjusts the color scheme based on the selected zodiac sign, creating a unique visual atmosphere
- **Smooth Animations**: All interface elements feature smooth transition animations, ensuring a seamless and comfortable user experience
- **Particle Background Effects**: Uses particle effects to simulate the dynamic feel of the starry sky, adding a touch of agility and vitality to the app

#### 📱 Responsive Design
- **Multi-Platform Compatible**: Whether on smartphones, tablets, or desktop computers, Mizu adapts perfectly, providing a consistent user experience
- **Touch Optimization**: Specifically optimized for touch devices, ensuring smooth interaction on mobile devices
- **Smart Scroll Handling**: Hides the default scrollbar while retaining smooth scrolling functionality, maintaining a clean and tidy interface

#### 🔮 Horoscope Readings
- **Comprehensive Zodiac Information**: Provides detailed horoscope readings for all 12 zodiac signs, covering health, love, career, and more
- **Personalized Data**: Includes lucky numbers, lucky colors, lucky time slots, and other personalized information to help you better understand your fortune
- **Real-Time Data Updates**: The app features a data caching mechanism to reduce unnecessary network requests and improve loading speed, ensuring you always have access to the latest information
- **Detailed Analysis Reports**: Provides in-depth analysis for each zodiac sign, including personality traits, strengths and weaknesses, compatibility suggestions, etc.

#### ✨ Design Highlights
- **Micro-Interactions**: Through subtle interactive design, such as haptic feedback when clicking buttons, enhancing the fun of use
- **Dynamic Data Display**: Uses number growth animations to make users more intuitively feel the changes in fortunes
- **Progress Bar Animations**: Displays zodiac traits in the form of dynamic progress bars, adding趣味性和可读性

### Technical Implementation

#### 🛠️ Technology Stack
- **Frontend Technology**: Developed using pure HTML, CSS, and JavaScript to ensure high performance and cross-platform compatibility
- **Graphics Rendering**: Uses Three.js to achieve real-time rendering of the starry background
- **Particle Effects**: Leverages particles.js to create delicate particle animation effects
- **Icon Font**: Uses iconfont and Font Awesome to provide high-quality icon support
- **Animation Effects**: Combines CSS animations and JavaScript animations to achieve complex and smooth interface transitions
- **API Integration**: Fetches real-time zodiac data through PHP backend API

### User Guide

#### 🌐 Online Experience
You can access the online version directly via the following link: [Mizu Horoscope Online Experience](https://xz.mizu7.top)

#### 💻 Local Setup

**Requirements**:
- Web server with PHP support (Apache/Nginx)
- Modern browser (WebGL support)
- Internet connection (for loading external resources)

**Deployment Steps**:

1. **Clone Repository**:
   ```bash
   git clone https://github.com/mizuof/mizu-horoscope.git
   cd mizu-horoscope
   ```

2. **Configure Web Server**:
   - Place project files in web server root directory
   - Ensure server supports PHP
   - Configure URL rewriting (if needed)

3. **Access Application**:
   - Open `http://your-domain.com` in browser

#### 📁 File Structure
```
mizu-horoscope/
├── index.html              # Main page file
├── api/
│   └── horoscope.php      # Horoscope data API
├── css/
│   └── (Style files)
├── js/
│   └── (JavaScript files)
├── assets/
│   └── (Images and resources)
└── README.md
```

### API Documentation

#### Horoscope Data Interface

**Endpoint**: `GET /api/horoscope.php`

**Parameters**:
- `sign` (required): Zodiac identifier (e.g., aries, taurus, gemini, etc.)

**Response Example**:
```json
{
  "basic_info": {
    "name": "Aries",
    "color": "#FF6B6B",
    "element": "Fire Sign",
    "date_range": "March 21 - April 19",
    "ruling_planet": "Mars",
    "personality": "Brave, passionate, impulsive, strong leadership",
    "strengths": ["Strong action ability", "Full of passion", "Frank and honest"],
    "weaknesses": ["Impatient", "Lack of patience", "Easily impulsive"],
    "date": "2024-01-15"
  },
  "lucky": {
    "number": 7,
    "color": {"name": "Classic Red", "hex": "#9A1F1A"},
    "time": "Afternoon period (15:00-17:00)",
    "day": "Tuesday",
    "compatibility": ["Best match: Leo, Sagittarius", "Good match: Gemini, Aquarius", "Need attention: Cancer, Capricorn"]
  },
  "analysis": {
    "health": {
      "score": 85,
      "evaluation": "Good health condition",
      "advice": "Maintain regular sleep schedule",
      "detailed_analysis": "Aries' health fortune is good today..."
    },
    "love": {
      "score": 78,
      "evaluation": "Stable relationship development",
      "advice": "Give sincere compliments at least once a day",
      "detailed_analysis": "Love aspect is relatively stable today..."
    },
    "career": {
      "score": 92,
      "evaluation": "Smooth career development",
      "advice": "Use SMART principles to set quarterly goals",
      "detailed_analysis": "Career fortune is excellent, work performance stands out..."
    },
    "element_traits": "Strong action ability and leadership",
    "daily_summary": "Today is Aries' lucky day! All aspects of fortune are excellent..."
  },
  "overall_score": 85,
  "updated_at": "2024-01-15 14:30:00"
}
```

### Custom Configuration

#### Modify Zodiac Configuration

Customize zodiac information in the `ZODIAC_CONFIG` array in `index.html`:

```javascript
const ZODIAC_CONFIG = [
  { 
    id: 'aries', 
    name: 'Aries', 
    icon: 'icon-baiyang', 
    angle: 0, 
    color: '#FF6B6B' 
  },
  // ... other zodiac configurations
];
```

#### Adjust Theme Colors

Change the overall theme by modifying CSS variables:

```css
:root {
  --primary: #8b5cf6;      /* Primary color */
  --secondary: #6366f1;    /* Secondary color */
  --background: #0f172a;   /* Background color */
  --text: #f8fafc;         /* Text color */
  --accent: #f59e0b;       /* Accent color */
}
```

### Browser Compatibility

| Browser | Version | Support |
|---------|---------|---------|
| Chrome | 60+ | ✅ Fully Supported |
| Firefox | 55+ | ✅ Fully Supported |
| Safari | 12+ | ✅ Fully Supported |
| Edge | 79+ | ✅ Fully Supported |
| iOS Safari | 12+ | ✅ Fully Supported |

### Development Roadmap

- [ ] Add user login and favorites functionality
- [ ] Implement weekly and monthly horoscopes
- [ ] Add zodiac compatibility analysis
- [ ] Develop mobile app
- [ ] Multi-language support

### Contributing

We welcome contributions of all kinds!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

### Changelog

#### v5.0
- Adapted to new API data structure
- Added detailed analysis module
- Optimized mobile experience
- Improved visual design

#### v4.7.5
- Added zodiac compatibility suggestions
- Improved caching mechanism
- Performance optimization

### Support

If you have any questions or suggestions, please contact us through:

- Submit an [Issue](https://github.com/mizuof/mizu-horoscope/issues)
- Send email to: support@mizu7.top

---

**Disclaimer**: The horoscope content provided by this application is for entertainment purposes only and should not be considered as professional advice.
