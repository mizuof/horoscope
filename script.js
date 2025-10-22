
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
    // 检测WebGL支持
    try {
        const canvas = document.createElement('canvas');
        const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
        if (!gl) throw new Error('WebGL not supported');
    } catch (e) {
        console.warn('WebGL not supported, falling back to simpler background');
        document.getElementById('starCanvas').style.display = 'none';
        return;
    }

    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
    renderer = new THREE.WebGLRenderer({ 
        canvas: document.querySelector('#starCanvas'),
        antialias: false,
        powerPreference: "low-power"
    });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // 创建粒子
    const positions = new Float32Array(8000 * 3); // 减少粒子数量
    const colors = new Float32Array(8000 * 3);
    for(let i = 0; i < 24000; i += 3) {
        positions[i] = (Math.random() - 0.5) * 2000;
        positions[i+1] = (Math.random() - 0.5) * 2000;
        positions[i+2] = (Math.random() - 0.5) * 2000;
        
        colors[i] = 0.8 + Math.random() * 0.2;
        colors[i+1] = 0.8 + Math.random() * 0.2;
        colors[i+2] = 0.9 + Math.random() * 0.1;
    }

    const geometry = new THREE.BufferGeometry();
    geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
    
    const material = new THREE.PointsMaterial({ 
        size: 1.2, // 减小粒子大小
        sizeAttenuation: true,
        vertexColors: true,
        transparent: true,
        opacity: 0.7
    });
    
    stars = new THREE.Points(geometry, material);
    scene.add(stars);

    camera.position.z = 600; // 更近的视距
    animateStars();
}

function animateStars() {
    requestAnimationFrame(animateStars);
    stars.rotation.x += 0.0001; // 减慢旋转速度
    stars.rotation.y += 0.00015;
    renderer.render(scene, camera);
}

// 粒子效果
function initParticles() {
    if (navigator.hardwareConcurrency < 2) return; // 低端设备不加载粒子
    
    particlesJS('particles', {
        "particles": {
            "number": { "value": 40, "density": { "enable": true, "value_area": 600 } },
            "color": { "value": "#8b5cf6" },
            "shape": { "type": "circle" },
            "opacity": {
                "value": 0.4,
                "random": true,
                "anim": { "enable": true, "speed": 1, "opacity_min": 0.1 }
            },
            "size": {
                "value": 2.5,
                "random": true,
                "anim": { "enable": true, "speed": 2, "size_min": 0.3 }
            },
            "line_linked": {
                "enable": true,
                "distance": 120,
                "color": "#8b5cf6",
                "opacity": 0.15,
                "width": 0.8
            },
            "move": {
                "enable": true,
                "speed": 0.8,
                "direction": "none",
                "random": true,
                "straight": false,
                "out_mode": "out",
                "bounce": false,
                "attract": { "enable": true, "rotateX": 500, "rotateY": 1000 }
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
        this.currentRequest = null;
        this.lastClickTime = 0;
        this.initWheel();
        this.initConnectors();
        this.setupEventListeners();
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
            
            node.addEventListener('click', (e) => this.handleZodiacClick(e, config));
            wheel.appendChild(node);
        });
        
        this.positionNodes();
        window.addEventListener('resize', () => this.positionNodes());
    }

    handleZodiacClick(e, config) {
        e.stopPropagation();
        
        // 双击防抖 (300ms间隔)
        const now = Date.now();
        if (now - this.lastClickTime < 300) {
            this.lastClickTime = 0;
            return;
        }
        this.lastClickTime = now;
        
        this.showHoroscope(config);
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
        if (this.isLoading && this.currentSign === config.id) return;
        
        // 取消之前的请求
        if (this.currentRequest) {
            this.currentRequest.abort();
            this.currentRequest = null;
        }
        
        this.isLoading = true;
        this.currentSign = config.id;
        
        // 更新UI状态
        if (this.activeNode) {
            this.activeNode.classList.remove('active');
        }
        this.activeNode = document.querySelector(`.zodiac-node[data-sign="${config.id}"]`);
        this.activeNode.classList.add('active');
        
        document.getElementById('modalBackdrop').classList.add('show');

        const card = document.getElementById('horoscopeCard');
        card.innerHTML = `
            <div class="loading-state">
                <div class="spinner"></div>
                <p>加载中...</p>
            </div>
        `;
        card.classList.add('show', 'loading');
        
        try {
            const controller = new AbortController();
            this.currentRequest = controller;
            
            const data = await this.getHoroscopeData(config.id, controller.signal);
            
            // 确保不是被取消的请求
            if (!controller.signal.aborted) {
                this.displayHoroscope(config, data);
            }
        } catch (error) {
            if (error.name !== 'AbortError') {
                console.error('加载运势失败:', error);
                this.displayError(config);
            }
        } finally {
            this.isLoading = false;
            this.currentRequest = null;
            card.classList.remove('loading');
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
    
    async getHoroscopeData(sign, signal, retryCount = 0) {
        const MAX_RETRIES = 2;
        const cacheKey = `${sign}-${new Date().toLocaleDateString()}`;
        
        // 检查内存缓存
        if (this.cache.has(cacheKey)) {
            return this.cache.get(cacheKey);
        }
        
        // 检查本地存储缓存
        try {
            const localStorageData = localStorage.getItem(`horoscope-${cacheKey}`);
            if (localStorageData) {
                const data = JSON.parse(localStorageData);
                this.cache.set(cacheKey, data);
                return data;
            }
        } catch (e) {
            console.warn('读取本地缓存失败', e);
        }
        
        try {
            // 使用新的API端点
            const response = await fetch(`https://xz.mizu7.top/api/horoscope.php?sign=${sign}`, {
                signal
            });
            
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            
            const data = await response.json();
            
            // 缓存数据
            this.cache.set(cacheKey, data);
            try {
                localStorage.setItem(`horoscope-${cacheKey}`, JSON.stringify(data));
            } catch (e) {
                console.warn('本地存储写入失败', e);
            }
            
            return data;
        } catch (error) {
            if (retryCount < MAX_RETRIES && !signal.aborted) {
                await new Promise(resolve => setTimeout(resolve, 1000 * (retryCount + 1)));
                return this.getHoroscopeData(sign, signal, retryCount + 1);
            }
            throw error;
        }
    }

    createParticles(color1, color2) {
        if (navigator.hardwareConcurrency < 2) return; // 低端设备不创建粒子
        
        const particlesContainer = document.getElementById('particles');
        particlesContainer.innerHTML = '';
        
        for (let i = 0; i < 15; i++) { // 减少粒子数量
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 6 + 3; // 减小粒子大小
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.background = `radial-gradient(circle, ${color1}, ${color2})`;
            particle.style.opacity = Math.random() * 0.5 + 0.2;
            particle.style.animationDelay = `${Math.random() * 3}s`;
            
            particlesContainer.appendChild(particle);
        }
    }

    animateNumber(element, target, duration = 1500) {
        return new Promise((resolve) => {
            const start = 0;
            const startTime = performance.now();
            
            const animate = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const value = Math.floor(progress * target);
                
                element.textContent = value;
                
                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    element.classList.remove('counting');
                    resolve();
                }
            };
            
            element.classList.add('counting');
            requestAnimationFrame(animate);
        });
    }

    lightenColor(color, percent) {
        // 简化版颜色变亮函数
        const num = parseInt(color.replace("#", ""), 16);
        const amt = Math.round(2.55 * percent);
        const R = Math.min((num >> 16) + amt, 255);
        const G = Math.min((num >> 8 & 0x00FF) + amt, 255);
        const B = Math.min((num & 0x0000FF) + amt, 255);
        
        return `#${(
            (1 << 24) + (R << 16) + (G << 8) + B
        ).toString(16).slice(1)}`;
    }

    async displayHoroscope(config, data) {
        const card = document.getElementById('horoscopeCard');
        const { basic_info, lucky, analysis, overall_score } = data;
        const { health, love, career } = analysis;
    
        // 使用星座主色和变亮色
        const color1 = config.color;
        const color2 = this.lightenColor(color1, 20);
        
        // 更新全局颜色变量
        document.documentElement.style.setProperty('--primary', color1);
        document.documentElement.style.setProperty('--secondary', color2);
        
        // 更新星盘节点颜色
        document.querySelectorAll('.zodiac-node').forEach(node => {
            node.style.borderColor = color1;
            node.style.boxShadow = `0 0 15px ${color1}`;
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
                        ${basic_info.date} | ${basic_info.element} | ${basic_info.date_range || ''}
                    </p>
                    <p style="margin: 0.2rem 0 0; opacity: 0.7; font-size: 0.8rem;">
                        守护行星: ${basic_info.ruling_planet || '未知'} | 性格: ${basic_info.personality || '未知'}
                    </p>
                </div>
            </div>
            
            <div class="stats-container">
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">健康指数</h3>
                    <div class="stat-value">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">${health.evaluation}</p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">${health.advice}</p>
                </div>
                
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">爱情运势</h3>
                    <div class="stat-value">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">${love.evaluation}</p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">${love.advice}</p>
                </div>
                
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">事业指数</h3>
                    <div class="stat-value">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
                    <p style="margin: 0.2rem 0; font-size: 0.85rem; opacity: 0.8;">${career.evaluation}</p>
                    <div class="stat-bar">
                        <div class="stat-bar-fill" style="width: 0%; background: linear-gradient(to right, ${color1}, ${color2});"></div>
                    </div>
                    <p style="margin: 0.5rem 0 0; font-size: 0.8rem; color: ${color1}">${career.advice}</p>
                </div>
                
                <div class="stat-item">
                    <h3 style="margin: 0 0 0.5rem; font-size: 1rem;">综合运势</h3>
                    <div class="stat-value">0<span style="font-size: 0.9rem; opacity: 0.7;">/100</span></div>
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
            
            <div class="lucky-grid">
                <div class="lucky-item">
                    <h4>幸运数字</h4>
                    <div class="lucky-value">${lucky.number}</div>
                </div>
                <div class="lucky-item">
                    <h4>幸运颜色</h4>
                    <div class="color-swatch" style="background: ${colorHex};"></div>
                    <div class="lucky-value">${colorName}</div>
                </div>
                <div class="lucky-item">
                    <h4>幸运时段</h4>
                    <div class="lucky-value">${lucky.time}</div>
                </div>
            </div>
            
            <div class="detailed-analysis">
                <div class="analysis-section">
                    <h4><i class="fas fa-heartbeat"></i> 健康分析</h4>
                    <div class="analysis-content">${health.detailed_analysis || health.evaluation}</div>
                </div>
                <div class="analysis-section">
                    <h4><i class="fas fa-heart"></i> 爱情分析</h4>
                    <div class="analysis-content">${love.detailed_analysis || love.evaluation}</div>
                </div>
                <div class="analysis-section">
                    <h4><i class="fas fa-briefcase"></i> 事业分析</h4>
                    <div class="analysis-content">${career.detailed_analysis || career.evaluation}</div>
                </div>
            </div>
            
            ${lucky.compatibility ? `
            <div class="compatibility-section">
                ${lucky.compatibility.map(item => `
                    <div class="compatibility-item">
                        <div class="compatibility-type">${item.split('：')[0]}</div>
                        <div class="compatibility-value">${item.split('：')[1]}</div>
                    </div>
                `).join('')}
            </div>
            ` : ''}
            
            ${analysis.daily_summary ? `
            <div class="daily-summary">
                <h3><i class="fas fa-star"></i> 今日总评</h3>
                <p>${analysis.daily_summary}</p>
            </div>
            ` : ''}
            
            <div style="margin-top: 1.2rem; text-align: center; opacity: 0.6; font-size: 0.75rem;">
                <p>向下滑动或点击外部关闭</p>
            </div>
        `;
        
        // 执行动画
        await Promise.all([
            this.animateNumber(document.querySelector('.stat-item:nth-child(1) .stat-value'), health.score),
            this.animateNumber(document.querySelector('.stat-item:nth-child(2) .stat-value'), love.score),
            this.animateNumber(document.querySelector('.stat-item:nth-child(3) .stat-value'), career.score),
            this.animateNumber(document.querySelector('.stat-item:nth-child(4) .stat-value'), overall_score)
        ]);
        
        // 更新进度条
        document.querySelectorAll('.stat-bar-fill').forEach((bar, index) => {
            const values = [health.score, love.score, career.score, overall_score];
            bar.style.width = `${values[index]}%`;
        });
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
        if (camera && renderer) {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }
        if (zodiacSystem) zodiacSystem.positionNodes();
    }, 200);
});
