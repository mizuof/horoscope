// 星座配置
const ZODIAC_CONFIG = [
    { id: 'aries', name: '白羊座', icon: 'icon-baiyang', angle: 0, color: '#FF6B6B' },
    { id: 'taurus', name: '金牛座', icon: 'icon-jinniu', angle: 30, color: '#4ECDC4' },
    { id: 'gemini', name: '双子座', icon: 'icon-shuangzi', angle: 60, color: '#45B7D1' },
    { id: 'cancer', name: '巨蟹座', icon: 'icon-juxie', angle: 90, color: '#FFBE0B' },
    { id: 'leo', name: '狮子座', icon: 'icon-shizi', angle: 120, color: '#FB5607' },
    { id: 'virgo', name: '处女座', icon: 'icon-chunv', angle: 150, color: '#83C5BE' },
    { id: 'libra', name: '天秤座', icon: 'icon-tiancheng', angle: 180, color: '#FFDDD2' },
    { id: 'scorpio', name: '天蝎座', icon: 'icon-tianxie', angle: 210, color: '#E29578' },
    { id: 'sagittarius', name: '射手座', icon: 'icon-sheshou', angle: 240, color: '#FF006E' },
    { id: 'capricorn', name: '摩羯座', icon: 'icon-mojie', angle: 270, color: '#3A86FF' },
    { id: 'aquarius', name: '水瓶座', icon: 'icon-shuiping', angle: 300, color: '#8338EC' },
    { id: 'pisces', name: '双鱼座', icon: 'icon-shuangyu', angle: 330, color: '#00BBF9' }
];

// 星空背景
let scene, camera, renderer, stars;
function initStarField() {
    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
    renderer = new THREE.WebGLRenderer({ 
        canvas: document.querySelector('#starCanvas'),
        antialias: true 
    });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // 创建粒子
    const positions = new Float32Array(10000 * 3);
    const colors = new Float32Array(10000 * 3);
    for(let i = 0; i < 30000; i += 3) {
        positions[i] = (Math.random() - 0.5) * 3000;
        positions[i+1] = (Math.random() - 0.5) * 3000;
        positions[i+2] = (Math.random() - 0.5) * 3000;
        
        colors[i] = 0.8 + Math.random() * 0.2;
        colors[i+1] = 0.8 + Math.random() * 0.2;
        colors[i+2] = 0.9 + Math.random() * 0.1;
    }

    const geometry = new THREE.BufferGeometry();
    geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
    
    const material = new THREE.PointsMaterial({ 
        size: 1.5,
        sizeAttenuation: true,
        vertexColors: true,
        transparent: true,
        opacity: 0.8
    });
    
    stars = new THREE.Points(geometry, material);
    scene.add(stars);

    // 添加星云效果
    const nebulaGeometry = new THREE.SphereGeometry(500, 32, 32);
    const nebulaMaterial = new THREE.MeshBasicMaterial({
        color: 0x8b5cf6,
        transparent: true,
        opacity: 0.05
    });
    const nebula = new THREE.Mesh(nebulaGeometry, nebulaMaterial);
    scene.add(nebula);

    camera.position.z = 800;
    animateStars();
}

function animateStars() {
    requestAnimationFrame(animateStars);
    stars.rotation.x += 0.0002;
    stars.rotation.y += 0.0003;
    renderer.render(scene, camera);
}

// 粒子效果
function initParticles() {
    particlesJS('particles', {
        "particles": {
            "number": { "value": 60, "density": { "enable": true, "value_area": 800 } },
            "color": { "value": "#8b5cf6" },
            "shape": { "type": "circle" },
            "opacity": {
                "value": 0.5,
                "random": true,
                "anim": { "enable": true, "speed": 1, "opacity_min": 0.1 }
            },
            "size": {
                "value": 3,
                "random": true,
                "anim": { "enable": true, "speed": 2, "size_min": 0.3 }
            },
            "line_linked": {
                "enable": true,
                "distance": 150,
                "color": "#8b5cf6",
                "opacity": 0.2,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 1,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": { "enable": true, "rotateX": 600, "rotateY": 1200 }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": { "enable": true, "mode": "repulse" },
                "onclick": { "enable": true, "mode": "push" }
            }
        }
    });
}

// 星座系统
class ZodiacSystem {
    constructor() {
        this.currentSign = null;
        this.activeNode = null;
        this.cache = new Map();
        this.isLoading = false;
        this.initWheel();
        this.initConnectors();
        this.setupEventListeners();
        this.touchStartY = 0;
        this.isDragging = false;
    }

    initWheel() {
        const wheel = document.getElementById('zodiacWheel');
        
        ZODIAC_CONFIG.forEach(config => {
            const node = document.createElement('div');
            node.className = 'zodiac-node';
            node.innerHTML = `<i class="iconfont ${config.icon}"></i>`;
            node.dataset.sign = config.id;
            node.style.color = config.color;
            node.style.borderColor = config.color;
            node.style.boxShadow = `0 0 15px ${config.color}`;
            
            node.addEventListener('click', (e) => {
                e.stopPropagation();
                if (!this.isLoading) {
                    this.showHoroscope(config);
                }
            });
            wheel.appendChild(node);
        });
        
        this.positionNodes();
        window.addEventListener('resize', () => this.positionNodes());
    }

    initConnectors() {
        const wheel = document.getElementById('zodiacWheel');
        const centerX = wheel.offsetWidth / 2;
        const centerY = wheel.offsetHeight / 2;

        ZODIAC_CONFIG.forEach(config => {
            const connector = document.createElement('div');
            connector.className = 'zodiac-connector';
            wheel.appendChild(connector);
        });
    }

    setupEventListeners() {
        const card = document.getElementById('horoscopeCard');
        const modalBackdrop = document.getElementById('modalBackdrop');
        
        // 优化触摸交互
        card.addEventListener('touchstart', (e) => {
            this.touchStartY = e.touches[0].clientY;
            this.isDragging = false;
            card.style.transition = 'none';
        }, { passive: true });
        
        card.addEventListener('touchmove', (e) => {
            if (!this.currentSign) return;
            
            const touchY = e.touches[0].clientY;
            const deltaY = touchY - this.touchStartY;
            
            // 只允许向下滑动关闭
            if (deltaY > 10) {
                e.preventDefault();
                this.isDragging = true;
                card.style.transform = `translateX(-50%) translateY(${deltaY}px)`;
            }
        }, { passive: false });
        
        card.addEventListener('touchend', (e) => {
            if (!this.currentSign || !this.isDragging) return;
            
            const touchY = e.changedTouches[0].clientY;
            const deltaY = touchY - this.touchStartY;
            card.style.transition = 'transform 0.3s cubic-bezier(0.2, 0.9, 0.3, 1.1)';
            
            // 滑动超过阈值则关闭
            if (deltaY > 100) {
                this.hideHoroscope();
            } else {
                card.style.transform = 'translateX(-50%) translateY(0)';
            }
            
            this.isDragging = false;
        }, { passive: true });
        
        // 点击遮罩层关闭
        modalBackdrop.addEventListener('click', () => {
            this.hideHoroscope();
        });
        
        // 阻止卡片点击事件冒泡
        card.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }

    positionNodes() {
        const wheel = document.getElementById('zodiacWheel');
        const wheelWidth = wheel.offsetWidth;
        const wheelHeight = wheel.offsetHeight;
        const radius = Math.min(wheelWidth, wheelHeight) * 0.35;
        
        const nodes = document.querySelectorAll('.zodiac-node');
        const connectors = document.querySelectorAll('.zodiac-connector');
        
        nodes.forEach((node, index) => {
            const angle = (ZODIAC_CONFIG[index].angle - 90) * Math.PI / 180;
            const x = Math.cos(angle) * radius;
            const y = Math.sin(angle) * radius;
            
            const nodeSize = parseInt(window.getComputedStyle(node).width) || 30;
            node.style.left = `${wheelWidth / 2 + x - nodeSize / 2}px`;
            node.style.top = `${wheelHeight / 2 + y - nodeSize / 2}px`;
    
            // 更新连接线
            if (connectors[index]) {
                const length = Math.sqrt(x * x + y * y);
                const angleDeg = Math.atan2(y, x) * 180 / Math.PI;
                connectors[index].style.width = `${length}px`;
                connectors[index].style.left = `${wheelWidth / 2}px`;
                connectors[index].style.top = `${wheelHeight / 2}px`;
                connectors[index].style.transform = `rotate(${angleDeg}deg)`;
            }
        });
    }

    async showHoroscope(config) {
        if (this.currentSign === config.id || this.isLoading) return;

        this.isLoading = true;
        
        if (this.activeNode) {
            this.activeNode.classList.remove('active');
        }
        
        this.currentSign = config.id;
        this.activeNode = document.querySelector(`.zodiac-node[data-sign="${config.id}"]`);
        this.activeNode.classList.add('active');

        document.getElementById('modalBackdrop').classList.add('show');

        const card = document.getElementById('horoscopeCard');
        card.innerHTML = `
            <div style="display: flex; justify-content: center; align-items: center; height: 200px;">
                <div class="loading-spinner"></div>
            </div>
        `;
        card.classList.add('show');
        
        try {
            const data = await this.getHoroscopeData(config.id);
            this.displayHoroscope(config, data);
        } catch (error) {
            console.error("Error fetching horoscope data:", error);
            this.displayError(config);
        } finally {
            this.isLoading = false;
        }
    }
    
    hideHoroscope() {
        if (!this.currentSign) return;
        
        const card = document.getElementById('horoscopeCard');
        const modalBackdrop = document.getElementById('modalBackdrop');

        card.classList.remove('show');
        modalBackdrop.classList.remove('show');

        setTimeout(() => {
            if (this.activeNode) {
                this.activeNode.classList.remove('active');
                this.activeNode = null;
            }
            this.currentSign = null;
            card.innerHTML = '';
        }, 500);
    }
    
    async getHoroscopeData(sign) {
        const cacheKey = `${sign}-${new Date().toLocaleDateString()}`;
        if (this.cache.has(cacheKey)) {
            return this.cache.get(cacheKey);
        }
        
        // 使用AbortController防止重复请求
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 5000);
        
        try {
            const response = await fetch(`https://xz.mizu7.top/api/horoscope.php?sign=${sign}`, {
                signal: controller.signal
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();

            if (!data.analysis) {
                data.analysis = this.generateAnalysis(sign);
            }
            if (!data.lucky_color) {
                data.lucky_color = this.getRandomColor();
            }
            if (!data.lucky_number) {
                data.lucky_number = Math.floor(Math.random() * 10) + 1;
            }
            
            this.cache.set(cacheKey, data);
            return data;
        } catch (error) {
            console.error("Fetch error:", error);
            throw error;
        } finally {
            clearTimeout(timeoutId);
        }
    }

    generateAnalysis(sign) {
        const aspects = ["事业", "爱情", "健康", "财运", "人际关系"];
        const qualities = ["极佳", "良好", "平稳", "需要注意", "充满挑战"];
        const advice = [
            "今天适合尝试新事物",
            "保持耐心会有好结果",
            "注意与同事的沟通方式",
            "财务上要谨慎决策",
            "感情方面会有惊喜",
            "健康方面要多加留意"
        ];
        
        return `今日${ZODIAC_CONFIG.find(z => z.id === sign).name}在${aspects[Math.floor(Math.random()*aspects.length)]}方面${qualities[Math.floor(Math.random()*qualities.length)]}。${advice[Math.floor(Math.random()*advice.length)]}。`;
    }

    getRandomColor() {
        const colors = ["红色", "蓝色", "绿色", "紫色", "金色", "银色", "粉色", "橙色"];
        return colors[Math.floor(Math.random() * colors.length)];
    }

    createParticles(color1, color2) {
        const particlesContainer = document.getElementById('particles');
        particlesContainer.innerHTML = '';
        
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 8 + 4;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.background = `radial-gradient(circle, ${color1}, ${color2})`;
            particle.style.opacity = Math.random() * 0.6 + 0.2;
            particle.style.animationDelay = `${Math.random() * 4}s`;
            
            particlesContainer.appendChild(particle);
        }
    }

    animateNumber(element, target, duration = 1500) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                clearInterval(timer);
                current = target;
                element.classList.remove('counting');
            }
            element.textContent = Math.floor(current);
        }, 16);
    }

    displayHoroscope(config, data) {
        const card = document.getElementById('horoscopeCard');
        const { basic_info, lucky, analysis, overall_score } = data;
        const { health, love, career } = analysis;
    
        // 动态渐变色 - 使用星座颜色
        const color1 = config.color;
        const color2 = this.lightenColor(config.color, 20);
        
        // 更新全局颜色变量
        document.documentElement.style.setProperty('--primary', color1);
        document.documentElement.style.setProperty('--secondary', color2);
        
        // 更新星盘节点颜色
        document.querySelectorAll('.zodiac-node').forEach(node => {
            node.style.borderColor = `var(--primary)`;
            node.style.boxShadow = `0 0 15px var(--primary)`;
        });
        
        this.createParticles(color1, color2);
    
        // 确保幸运颜色数据存在
        const luckyColor = lucky.color || {};
        const colorHex = typeof luckyColor === 'string' ? color1 : luckyColor.hex;
        const colorName = typeof luckyColor === 'string' ? luckyColor : luckyColor.name;
    
        card.innerHTML = `
            <div class="card-header">
                <div class="zodiac-icon" style="background: ${color1}; box-shadow: 0 0 20px ${color1}">
                    <i class="iconfont ${config.icon}"></i>
                </div>
                <div>
                    <h2 style="margin: 0; font-size: 1.8rem; background: linear-gradient(to right, ${color1}, ${color2}); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        ${basic_info.name}今日运势
                    </h2>
                    <p style="margin: 0.5rem 0 0; opacity: 0.8; font-size: 0.9rem;">
                        ${basic_info.date} | ${basic_info.element}
                    </p>
                </div>
            </div>
            
            <div class="stats-container">
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">健康指数</h3>
                    <div class="stat-value counting">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">${health.evaluation}</p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">${health.advice}</p>
                </div>
                
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">爱情运势</h3>
                    <div class="stat-value counting">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">${love.evaluation}</p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">${love.advice}</p>
                </div>
                
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">事业指数</h3>
                    <div class="stat-value counting">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">${career.evaluation}</p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">${career.advice}</p>
                </div>
                
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">综合运势</h3>
                    <div class="stat-value counting">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">
                        ${overall_score > 80 ? '吉星高照' : overall_score > 60 ? '平稳发展' : '需谨慎行事'}
                    </p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">
                        星座特质：${analysis.element_traits}
                    </p>
                </div>
            </div>
            
            <div style="display: flex; justify-content: space-between; margin-top: 1.5rem; background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 0.8rem; border: 1px solid ${color1}20;">
                <div style="text-align: center; flex: 1;">
                    <h4 style="margin: 0 0 0.5rem; opacity: 0.8; font-size: 0.9rem;">幸运数字</h4>
                    <div style="font-size: 1.8rem; font-weight: bold; color: ${color1}">${lucky.number}</div>
                </div>
                <div style="width: 1px; background: rgba(255,255,255,0.2); margin: 0 0.5rem;"></div>
                <div style="text-align: center; flex: 1;">
                    <h4 style="margin: 0 0 0.5rem; opacity: 0.8; font-size: 0.9rem;">幸运颜色</h4>
                    <div style="width: 26px; height: 26px; border-radius: 50%; background: ${colorHex}; margin: 0.3rem auto 0; border: 2px solid white;"></div>
                    <div style="font-size: 1rem; font-weight: bold; color: ${colorHex}">${colorName}</div>
                </div>
                <div style="width: 1px; background: rgba(255,255,255,0.2); margin: 0 0.5rem;"></div>
                <div style="text-align: center; flex: 1;">
                    <h4 style="margin: 0 0 0.5rem; opacity: 0.8; font-size: 0.9rem;">幸运时段</h4>
                    <div style="font-size: 1rem; font-weight: bold; color: ${color1}">${lucky.time}</div>
                </div>
            </div>
            
            <div style="margin-top: 1.2rem; text-align: center; opacity: 0.6; font-size: 0.75rem;">
                <p>向下滑动或点击外部关闭</p>
            </div>
        `;
        
        card.classList.add('show');
        
        // 触发数字增长动画和进度条动画
        setTimeout(() => {
            const healthValue = document.querySelector('.stat-item:nth-child(1) .stat-value');
            const loveValue = document.querySelector('.stat-item:nth-child(2) .stat-value');
            const careerValue = document.querySelector('.stat-item:nth-child(3) .stat-value');
            const overallValue = document.querySelector('.stat-item:nth-child(4) .stat-value');
            
            this.animateNumber(healthValue, health.score);
            this.animateNumber(loveValue, love.score);
            this.animateNumber(careerValue, career.score);
            this.animateNumber(overallValue, overall_score);
            
            // 进度条动画
            document.querySelectorAll('.stat-bar-fill').forEach((bar, index) => {
                const values = [health.score, love.score, career.score, overall_score];
                setTimeout(() => {
                    bar.style.width = `${values[index]}%`;
                }, index * 200);
            });
        }, 100);
    }
    
    lightenColor(color, percent) {
        const num = parseInt(color.replace("#", ""), 16);
        const amt = Math.round(2.55 * percent);
        const R = (num >> 16) + amt;
        const G = (num >> 8 & 0x00FF) + amt;
        const B = (num & 0x0000FF) + amt;
        
        return `#${(
            0x1000000 +
            (R < 255 ? (R < 1 ? 0 : R) : 255) * 0x10000 +
            (G < 255 ? (G < 1 ? 0 : G) : 255) * 0x100 +
            (B < 255 ? (B < 1 ? 0 : B) : 255)
        ).toString(16).slice(1)}`;
    }
    
    displayError(config) {
        const card = document.getElementById('horoscopeCard');
        card.innerHTML = `
            <div style="text-align: center; padding: 2rem;">
                <div style="font-size: 3rem; color: #ff4757; margin-bottom: 1rem;">⚠️</div>
                <h2 style="color: ${config.color}">加载失败</h2>
                <p style="margin-bottom: 1rem;">无法获取${config.name}的运势数据，请稍后再试。</p>
                <button onclick="zodiacSystem.showHoroscope(${JSON.stringify(config).replace(/"/g, '&quot;')})" style="background: ${config.color}; border: none; padding: 0.6rem 1.2rem; border-radius: 2rem; color: white; cursor: pointer; font-size: 0.9rem;">重新加载</button>
            </div>
        `;
        card.classList.add('show');
    }
}

let zodiacSystem;

window.addEventListener('load', () => {
    setTimeout(() => {
        document.getElementById('loading').style.opacity = '0';
        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
        }, 1000);
    }, 1500);
    
    initStarField();
    initParticles();
    zodiacSystem = new ZodiacSystem();
});

window.addEventListener('resize', () => {
    if (window.resizeTimer) clearTimeout(window.resizeTimer);
    window.resizeTimer = setTimeout(() => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
        zodiacSystem.positionNodes();
    }, 200);
});
