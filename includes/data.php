<?php
/**
 * Shree Tech - Central Data Store
 */

$companyInfo = [
    'name' => 'Shree Tech',
    'tagline' => 'Innovations',
    'title' => 'Shree Tech | Software Engineering & Cloud Solutions',
    'phone' => '+1 (800) 840-2030',
    'email' => 'contact@shreetech.com',
    'address' => '5/2, Hajiyar Complex 1st Floor, Moulana Sahip Street, Anna Nagar, Madurai - 625020, Tamil Nadu, India.',
    'copyright' => '© ' . date('Y') . ' Shree Tech Innovations Inc. All rights reserved.'
];

$navLinks = [
    ['label' => 'Home', 'href' => 'index.php#home', 'page' => 'home'],
    ['label' => 'About', 'href' => 'index.php#about', 'page' => 'about'],
    ['label' => 'Services', 'href' => 'index.php#services', 'page' => 'services'],
    ['label' => 'Technologies', 'href' => 'index.php#technologies', 'page' => 'technologies'],
    ['label' => 'Projects', 'href' => 'index.php#projects', 'page' => 'projects'],
    ['label' => 'Careers', 'href' => 'careers.php', 'page' => 'careers'],
];

$servicesData = [
    [
        'id' => 'website-development',
        'title' => 'Website Development',
        'description' => 'High-performance corporate websites and modern web platforms built with Next.js, React, and TypeScript. Optimized for sub-second load times, technical SEO, and exceptional responsiveness.',
        'iconName' => 'globe',
        'deliverables' => [
            'Custom Next.js & React Architectures',
            'Core Web Vitals & Technical SEO',
            'Responsive Cross-Device Layouts',
            'Headless CMS Integration'
        ]
    ],
    [
        'id' => 'mobile-app-development',
        'title' => 'Mobile Application Development',
        'description' => 'Native and cross-platform mobile apps for iOS and Android powered by Flutter and React Native. Smooth 60 FPS interfaces, offline-first synchronization, and secure biometrics.',
        'iconName' => 'smartphone',
        'deliverables' => [
            'Cross-Platform Flutter & React Native',
            'App Store & Play Store Deployments',
            'Secure Payment & Push Systems',
            'Offline Data Synchronization'
        ]
    ],
    [
        'id' => 'custom-software-development',
        'title' => 'Custom Software Development',
        'description' => 'Tailored enterprise software and distributed backend microservices engineered to solve complex operational challenges, automate workflows, and handle millions of transactions.',
        'iconName' => 'code-2',
        'deliverables' => [
            'Distributed Microservice Architectures',
            'High-Throughput RESTful & GraphQL APIs',
            'Role-Based Access & Security Protocols',
            'Automated CI/CD Test Pipelines'
        ]
    ],
    [
        'id' => 'ui-ux-design',
        'title' => 'UI/UX Design',
        'description' => 'Human-centered user experience design, comprehensive design systems, and modern digital interfaces. We combine in-depth user research with intuitive usability and design tokens.',
        'iconName' => 'layout',
        'deliverables' => [
            'User Journey & Usability Research',
            'Figma Interactive Prototypes & Tokens',
            'Component Design Systems',
            'Accessibility (WCAG 2.1 AA) Compliance'
        ]
    ],
    [
        'id' => 'ecommerce-development',
        'title' => 'E-Commerce Development',
        'description' => 'Scalable commerce storefronts and custom checkout experiences utilizing headless architectures, Shopify Plus, and bespoke payment gateways for international conversions.',
        'iconName' => 'shopping-bag',
        'deliverables' => [
            'Headless Storefront Implementations',
            'Global Payment & Currency Gateways',
            'ERP & Real-Time Inventory Sync',
            'Conversion Rate Optimization (CRO)'
        ]
    ],
    [
        'id' => 'cloud-devops',
        'title' => 'Cloud & DevOps',
        'description' => 'Enterprise cloud migration, container orchestration with Kubernetes, and Infrastructure as Code with Terraform across AWS, Azure, and Google Cloud environments.',
        'iconName' => 'cloud',
        'deliverables' => [
            'Multi-Cloud Infrastructure (AWS & Azure)',
            'Kubernetes & Docker Containerization',
            'Infrastructure as Code (Terraform)',
            'Zero-Downtime Deployment Strategies'
        ]
    ],
    [
        'id' => 'digital-transformation',
        'title' => 'Digital Transformation',
        'description' => 'Modernizing legacy architectures and transitioning outdated systems into agile, cloud-native digital ecosystems that increase organizational efficiency and market agility.',
        'iconName' => 'refresh-cw',
        'deliverables' => [
            'Legacy Monolith Modernization',
            'Data Pipeline & Analytics Consolidation',
            'Executive Technology Roadmapping',
            'Operational Workflow Automation'
        ]
    ],
    [
        'id' => 'ai-automation',
        'title' => 'AI & Automation',
        'description' => 'Practical artificial intelligence integration, retrieval-augmented generation (RAG), automated data pipelines, and intelligent process automation tailored to your proprietary data.',
        'iconName' => 'cpu',
        'deliverables' => [
            'Enterprise Knowledge Bases & RAG',
            'Intelligent Document & Data Processing',
            'Custom ML Model Deployment',
            'Automated Back-Office Workflows'
        ]
    ]
];

$processSteps = [
    [
        'number' => '01',
        'title' => 'Requirement Analysis',
        'description' => 'We work closely with your stakeholders to define business objectives, user requirements, technical constraints, and clear KPIs for project success.',
        'deliverables' => ['Scope & Objective Definition', 'Stakeholder Interviews', 'Technical Feasibility Study']
    ],
    [
        'number' => '02',
        'title' => 'Planning & Strategy',
        'description' => 'Our senior architects construct an engineering roadmap, database schemas, system architecture blueprints, and milestone sprint schedules.',
        'deliverables' => ['System Architecture Blueprint', 'Tech Stack Selection', 'Sprint Delivery Milestones']
    ],
    [
        'number' => '03',
        'title' => 'UI/UX Design',
        'description' => 'We craft human-centric user journeys, wireframes, accessible design systems, and high-fidelity interactive prototypes tested with real users.',
        'deliverables' => ['User Flow & Wireframing', 'Figma Interactive Prototypes', 'Design System & Tokens']
    ],
    [
        'number' => '04',
        'title' => 'Development',
        'description' => 'Our development team writes clean, type-safe, modular code following Domain-Driven Design principles, automated CI/CD pipelines, and regular demo checkpoints.',
        'deliverables' => ['Agile Two-Week Sprints', 'Test-Driven Codebase', 'Weekly Staging Deployments']
    ],
    [
        'number' => '05',
        'title' => 'Testing & Quality Assurance',
        'description' => 'Rigorous automated unit testing, end-to-end integration tests, load stress testing, cross-browser compatibility checks, and security vulnerability scans.',
        'deliverables' => ['Automated End-to-End Tests', 'Load & Stress Benchmarks', 'Security & Penetration Audit']
    ],
    [
        'number' => '06',
        'title' => 'Deployment & Support',
        'description' => 'Zero-downtime production deployment, cloud monitoring configuration, staff handover documentation, and ongoing SLA maintenance agreements.',
        'deliverables' => ['Zero-Downtime Rollout', 'Cloud Telemetry & Logging', 'Dedicated SLA Maintenance']
    ]
];

$projectsData = [
    [
        'id' => 'apex-finance',
        'title' => 'Eyecatch Media ',
        'category' => 'web',
        'categoryLabel' => 'News & Media Portal',
        'client' => 'Eyecatch Media Network',
        'year' => '2026',
        'summary' => 'Dynamic news, digital publishing, and high-traffic multimedia portal delivering real-time breaking news feeds, multilingual regional journalism, and responsive content streaming.',
        'technologies' => ['PHP', 'Laravel', 'MySQL', 'Tailwind CSS', 'JavaScript'],
        'imageUrl' => 'eyecatch-media.png',
        'layoutSpan' => 'featured',
        'metrics' => ['label' => 'Monthly Readers', 'value' => '1.2M+']
    ],
    [
        'id' => 'health-cloud',
        'title' => 'Kiaura Research & Publications',
        'category' => 'enterprise',
        'categoryLabel' => 'Research & Publishing',
        'client' => 'Kiaura Innovations & Publications',
        'year' => '2025',
        'summary' => 'Comprehensive academic research publishing platform and digital monograph distribution portal with peer-review workflow management, book catalog indexing, and automated order processing.',
        'technologies' => ['PHP', 'Laravel', 'MySQL', 'Tailwind CSS', 'Bootstrap'],
        'imageUrl' => 'assets/images/kiaurra.png',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Publications Indexed', 'value' => '10,000+']
    ],
    [
        'id' => 'fleet-mobile',
        'title' => 'Blood Donor Emergency App',
        'category' => 'mobile',
        'categoryLabel' => 'Mobile Application',
        'client' => 'Blood Donor Network',
        'year' => '2025',
        'summary' => 'Real-time GPS blood donor identification and emergency alert application connecting voluntary donors with patients and regional blood banks in critical care scenarios.',
        'technologies' => ['Flutter', 'Firebase', 'Google Maps API', 'Node.js', 'REST APIs'],
        'imageUrl' => 'assets/images/blood donor.webp',
        'imageFit' => 'contain',
        'imageBg' => '#DA0037',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Verified Donors', 'value' => '25,000+']
    ],
    [
        'id' => 'luxury-commerce',
        'title' => 'Eekai Charitable Trust Portal',
        'category' => 'web',
        'categoryLabel' => 'Non-Profit & Crowdfunding',
        'client' => 'Eekai Foundation',
        'year' => '2025',
        'summary' => 'Comprehensive non-profit crowdfunding and donor engagement platform featuring secure multi-tier donation processing, cause campaign tracking, and community outreach management.',
        'technologies' => ['PHP', 'Laravel', 'MySQL', 'Tailwind CSS', 'Razorpay API'],
        'imageUrl' => 'assets/images/eekai-trust.png',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Lives Impacted', 'value' => '50,000+']
    ],
    [
        'id' => 'cloud-security',
        'title' => 'Indhian Press Club News Portal',
        'category' => 'web',
        'categoryLabel' => 'Digital Journalism & Media',
        'client' => 'Indhian Press Club',
        'year' => '2025',
        'summary' => 'High-traffic digital journalism and news publishing platform delivering real-time regional and national reporting, multi-category content curation, and fast media streaming.',
        'technologies' => ['PHP', 'Laravel', 'MySQL', 'Tailwind CSS', 'Redis'],
        'imageUrl' => 'assets/images/indian-press-club.png',
        'layoutSpan' => 'featured',
        'metrics' => ['label' => 'Monthly Readers', 'value' => '2.5M+']
    ],
    [
        'id' => 'ai-intelligence',
        'title' => 'Evergreen Classifieds & Ads Portal',
        'category' => 'enterprise',
        'categoryLabel' => 'Marketplace & Directory',
        'client' => 'Evergreen Classifieds Network',
        'year' => '2025',
        'summary' => 'Comprehensive online classifieds, business directory, and digital advertising marketplace engineered with localized category filtering, high-visibility ad placements, and fast search indexing.',
        'technologies' => ['PHP', 'Laravel', 'MySQL', 'Bootstrap', 'JavaScript'],
        'imageUrl' => 'evergreen-ads.png',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Active Listings', 'value' => '50,000+']
    ]
];

$testimonialsData = [
    [
        'id' => '1',
        'name' => 'Sarah Jenkins',
        'designation' => 'Chief Technology Officer',
        'company' => 'Apex Financial Technologies',
        'content' => 'Shree Tech delivered our institutional trading dashboard on time and under budget. Their senior engineers demonstrated exceptional mastery over Next.js and real-time WebSocket pipelines. The code quality and documentation made internal handover seamless.',
        'imageUrl' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=240&q=80',
        'rating' => 5,
        'scope' => 'Institutional trading portal, real-time WebSocket book, order execution',
        'stack' => 'Next.js 16, TypeScript, Node.js, PostgreSQL, Docker',
        'outcome' => 'Sub-50ms latencies, zero downtime during launch, $45M+ volume'
    ],
    [
        'id' => '2',
        'name' => 'David Thorne',
        'designation' => 'VP of Product Engineering',
        'company' => 'CareSync Health Systems',
        'content' => 'Finding an engineering partner that genuinely understands both modern UI/UX design and strict HIPAA compliance is rare. Shree Tech bridged that gap effortlessly. They operate with the rigor and transparency of an in-house senior team.',
        'imageUrl' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=240&q=80',
        'rating' => 5,
        'scope' => 'HIPAA EHR Suite, teleconsultation pipeline, provider portal',
        'stack' => 'React 19, Python, FastAPI, AWS HIPAA Cloud, PostgreSQL',
        'outcome' => '350,000+ patient records managed, SOC2 & HIPAA certified'
    ],
    [
        'id' => '3',
        'name' => 'Elena Rostova',
        'designation' => 'Head of Digital Products',
        'company' => 'Veloce Logistics Group',
        'content' => 'Our mobile dispatch app had complex offline data sync and hardware constraints. Shree Tech engineered a Flutter solution that performed flawlessly across 4,500 active drivers within the first month. We consider them a long-term strategic technology partner.',
        'imageUrl' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=240&q=80',
        'rating' => 5,
        'scope' => 'Mobile driver dispatch, offline geofencing, GPS route balancing',
        'stack' => 'Flutter, Dart, Firebase, Node.js, MongoDB',
        'outcome' => '+34% driver turnaround efficiency, 4.9 App Store rating'
    ],
    [
        'id' => '4',
        'name' => 'Michael Chen',
        'designation' => 'Managing Director',
        'company' => 'Nordic Cloud Hosting',
        'content' => 'Their architectural foresight saved us months of rework. By implementing clean Kubernetes containerization and Infrastructure as Code from day one, our multi-cloud deployment operates with 99.999% reliability. Highly recommended.',
        'imageUrl' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=240&q=80',
        'rating' => 5,
        'scope' => 'Multi-region Kubernetes mesh, Terraform IaC, automated failover',
        'stack' => 'AWS, Azure, Kubernetes, Terraform, Prometheus, Go',
        'outcome' => '99.999% verified uptime, 60% cloud compute cost savings'
    ]
];

$whyChooseUsData = [
    [
        'id' => 'experienced-team',
        'title' => 'Experienced Development Team',
        'description' => 'Our core team consists of senior engineers and product designers with extensive enterprise backgrounds. We write clean, maintainable code built for long-term viability.',
        'iconName' => 'users',
        'metric' => 'Senior-Level Engineers',
        'guarantees' => [
            'Direct collaboration with senior engineers',
            'Strict type-safety & automated test coverage',
            'Zero offshore subcontractor pass-throughs'
        ]
    ],
    [
        'id' => 'modern-stack',
        'title' => 'Modern Technology Stack',
        'description' => 'We develop using battle-tested modern frameworks—Next.js, React, TypeScript, Flutter, Python, and AWS—avoiding deprecated legacy patterns while guaranteeing speed and reliability.',
        'iconName' => 'layers',
        'metric' => 'Production-Proven Tech',
        'guarantees' => [
            'Next.js 16, React 19, TypeScript & Flutter',
            'Sub-second load times & 60 FPS mobile UI',
            'Clean, maintainable domain architectures'
        ]
    ],
    [
        'id' => 'quality-focused',
        'title' => 'Quality-Focused Development',
        'description' => 'Every release is subjected to automated regression suites, static type checking, peer code reviews, and strict security compliance checks before reaching production.',
        'iconName' => 'check-circle-2',
        'metric' => '99.4% First-Pass QA',
        'guarantees' => [
            'Automated end-to-end regression testing',
            'Continuous security & dependency scanning',
            'Rigorous peer-reviewed PR workflows'
        ]
    ],
    [
        'id' => 'scalable-architecture',
        'title' => 'Scalable Architecture',
        'description' => 'We build distributed, cloud-native systems designed to gracefully support rapid business growth, from initial launch to millions of monthly active users.',
        'iconName' => 'trending-up',
        'metric' => 'Elastic High-Scale',
        'guarantees' => [
            'Multi-region elastic cloud deployments',
            'Horizontal database sharding & caching',
            'Resilient microservices & serverless pipelines'
        ]
    ],
    [
        'id' => 'reliable-support',
        'title' => 'Reliable Support',
        'description' => 'Our engagement continues well beyond launch with structured SLAs, 24/7 cloud infrastructure monitoring, regular security updates, and performance tuning.',
        'iconName' => 'shield-check',
        'metric' => 'Guaranteed SLA Uptime',
        'guarantees' => [
            'Guaranteed 1-hour critical response SLAs',
            '24/7 automated infrastructure monitoring',
            'Proactive security patches & dependency updates'
        ]
    ],
    [
        'id' => 'client-centered',
        'title' => 'Client-Centered Solutions',
        'description' => 'We tailor our development workflows to your internal roadmap. Transparent communication, direct engineer access, and regular sprint reviews keep you in full control.',
        'iconName' => 'heart-handshake',
        'metric' => '98% Client Satisfaction',
        'guarantees' => [
            'Transparent agile sprint ceremonies & demos',
            'Direct Slack & GitHub repository access',
            'Predictable delivery milestones & budgets'
        ]
    ]
];

$technologyGroups = [
    [
        'category' => 'Frontend',
        'uniqueHeading' => 'Frontend Languages & UI',
        'subtitle' => 'HTML5, CSS3, JavaScript, React.js, Next.js',
        'badge' => 'eg: HTML, CSS, JS',
        'icon' => 'code',
        'description' => 'Semantic markup, modern styling, and reactive component frameworks delivering fast, accessible, responsive web interfaces.',
        'items' => [
            ['name' => 'HTML5', 'description' => 'Semantic, accessible markup standards', 'iconComponent' => 'HtmlLogo', 'tag' => 'Frontend Language'],
            ['name' => 'CSS3', 'description' => 'Responsive design & modern layouts', 'iconComponent' => 'CssLogo', 'tag' => 'Frontend Styling'],
            ['name' => 'JavaScript', 'description' => 'ESNext interactive web scripting', 'iconComponent' => 'JavaScriptLogo', 'tag' => 'Frontend Language'],
            ['name' => 'React.js', 'description' => 'Declarative component-driven interfaces', 'iconComponent' => 'ReactLogo', 'tag' => 'UI Framework'],
            ['name' => 'Next.js', 'description' => 'Server-side rendering & App Router', 'iconComponent' => 'NextLogo', 'tag' => 'Full-Stack React'],
        ]
    ],
    [
        'category' => 'Backend',
        'uniqueHeading' => 'Backend & Server Frameworks',
        'subtitle' => 'PHP, Laravel, Python, Node.js, Java',
        'badge' => 'eg: PHP, Python, Node',
        'icon' => 'server',
        'description' => 'Resilient server runtimes and enterprise frameworks built for high concurrency, microservices, and robust data handling.',
        'items' => [
            ['name' => 'PHP', 'description' => 'Battle-tested server-side web scripting', 'iconComponent' => 'PhpLogo', 'tag' => 'Server Language'],
            ['name' => 'Laravel', 'description' => 'Full-featured enterprise PHP web framework', 'iconComponent' => 'LaravelLogo', 'tag' => 'MVC Framework'],
            ['name' => 'Python', 'description' => 'Data processing, APIs, and AI automation', 'iconComponent' => 'PythonLogo', 'tag' => 'Backend & AI'],
            ['name' => 'Node.js', 'description' => 'Event-driven asynchronous backend services', 'iconComponent' => 'NodeLogo', 'tag' => 'Async Runtime'],
            ['name' => 'Java', 'description' => 'Enterprise-grade robust application platform', 'iconComponent' => 'JavaLogo', 'tag' => 'Enterprise Platform'],
        ]
    ],
    [
        'category' => 'Database',
        'uniqueHeading' => 'Database & Storage Systems',
        'subtitle' => 'MySQL, MongoDB, PostgreSQL, Redis, Firebase',
        'badge' => 'eg: MySQL, Mongo, Redis',
        'icon' => 'database',
        'description' => 'Relational, document, and analytical databases engineered for extreme data integrity and high transaction throughput.',
        'items' => [
            ['name' => 'MySQL', 'description' => 'High-reliability transactional relational DB', 'iconComponent' => 'MySqlLogo', 'tag' => 'Relational DB'],
            ['name' => 'MongoDB', 'description' => 'Document-based flexible NoSQL database', 'iconComponent' => 'MongoLogo', 'tag' => 'NoSQL Database'],
            ['name' => 'PostgreSQL', 'description' => 'Advanced open-source relational database', 'iconComponent' => 'PostgresLogo', 'tag' => 'Relational DB'],
            ['name' => 'Redis', 'description' => 'In-memory high-speed caching & key-value store', 'iconComponent' => 'RedisLogo', 'tag' => 'In-Memory Cache'],
            ['name' => 'Firebase', 'description' => 'Real-time database, auth & cloud functions', 'iconComponent' => 'FirebaseLogo', 'tag' => 'Realtime DB'],
        ]
    ],
    [
        'category' => 'Mobile',
        'uniqueHeading' => 'Mobile & Native Architecture',
        'subtitle' => 'Flutter, React Native, Swift, iOS, Android',
        'badge' => 'eg: Flutter, Swift, iOS',
        'icon' => 'smartphone',
        'description' => 'Cross-platform native mobile frameworks delivering fluid 60FPS experiences for iOS and Android platforms.',
        'items' => [
            ['name' => 'Flutter', 'description' => 'Google native multi-platform compilation', 'iconComponent' => 'FlutterLogo', 'tag' => 'Cross-Platform'],
            ['name' => 'React Native', 'description' => 'Native mobile components powered by React', 'iconComponent' => 'ReactNativeLogo', 'tag' => 'Mobile Framework'],
            ['name' => 'Swift', 'description' => 'High-performance, type-safe iOS architecture', 'iconComponent' => 'SwiftLogo', 'tag' => 'iOS Native'],
            ['name' => 'iOS', 'description' => 'Native Apple iOS development with Swift', 'iconComponent' => 'IosLogo', 'tag' => 'Apple Ecosystem'],
            ['name' => 'Android', 'description' => 'Native Android SDK & modern Kotlin runtime', 'iconComponent' => 'AndroidLogo', 'tag' => 'Android Native'],
        ]
    ],
    [
        'category' => 'Cloud',
        'uniqueHeading' => 'Cloud & DevOps Engineering',
        'subtitle' => 'AWS, Azure, Google Cloud, Docker, Kubernetes',
        'badge' => 'eg: AWS, Azure, Docker',
        'icon' => 'cloud',
        'description' => 'Secure, elastic cloud hosting, container orchestration, and serverless infrastructures engineered for zero downtime.',
        'items' => [
            ['name' => 'AWS', 'description' => 'Global cloud infrastructure & services', 'iconComponent' => 'AwsLogo', 'tag' => 'Cloud Infrastructure'],
            ['name' => 'Azure', 'description' => 'Enterprise cloud computing & hybrid solutions', 'iconComponent' => 'AzureLogo', 'tag' => 'Enterprise Cloud'],
            ['name' => 'Google Cloud', 'description' => 'Scalable cloud platform & BigQuery analytics', 'iconComponent' => 'GcpLogo', 'tag' => 'Cloud & AI Platform'],
            ['name' => 'Docker', 'description' => 'Industry-standard container virtualization', 'iconComponent' => 'DockerLogo', 'tag' => 'Containerization'],
            ['name' => 'Kubernetes', 'description' => 'Automated container orchestration & scaling', 'iconComponent' => 'K8sLogo', 'tag' => 'Container Orchestration'],
        ]
    ]
];

/**
 * Render brand SVG tech logos
 */
function renderTechLogo($iconComponent, $class = 'w-6 h-6') {
    switch ($iconComponent) {
        case 'ReactLogo':
        case 'ReactNativeLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="-11.5 -10.23174 23 20.46348" fill="none"><circle cx="0" cy="0" r="2.05" fill="#61DAFB"/><g stroke="#61DAFB" stroke-width="1" fill="none"><ellipse rx="11" ry="4.2"/><ellipse rx="11" ry="4.2" transform="rotate(60)"/><ellipse rx="11" ry="4.2" transform="rotate(120)"/></g></svg>';
        case 'NextLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 180 180" fill="none"><circle cx="90" cy="90" r="90" fill="#000000"/><path d="M149.5 157.5L69.1 54H54v72h12.1V69.4L140 164.8c3.3-2.2 6.5-4.7 9.5-7.3z" fill="#ffffff"/><rect x="115" y="54" width="12" height="72" fill="#ffffff"/></svg>';
        case 'HtmlLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 512 512" fill="currentColor"><path fill="#E34F26" d="M71 460L30 0h452l-41 460-185 52z"/><path fill="#EF652A" d="M256 472l149-41 35-391H256v432z"/><path fill="#EBEBEB" d="M256 176h-60l-4-47h64V82H133l12 141h111zm0 137l-52-14-3-38h-47l6 71 96 27z"/><path fill="#FFFFFF" d="M256 82v47h119l-11 123H256v47h66l-6 71-60 16v50l96-27 13-145 2-25 1-10 1-13 1-12z"/></svg>';
        case 'CssLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 512 512" fill="currentColor"><path fill="#1572B6" d="M71 460L30 0h452l-41 460-185 52z"/><path fill="#33A9DC" d="M256 472l149-41 35-391H256v432z"/><path fill="#EBEBEB" d="M256 176h-60l-4-47h64V82H133l12 141h111zm0 137l-52-14-3-38h-47l6 71 96 27z"/><path fill="#FFFFFF" d="M256 82v47h119l-11 123H256v47h66l-6 71-60 16v50l96-27 13-145 2-25 1-10 1-13 1-12z"/></svg>';
        case 'JavaScriptLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 630 630"><rect width="630" height="630" fill="#F7DF1E" rx="60"/><path d="m423.2 492.19c12.69 20.72 29.2 35.95 58.4 35.95 24.53 0 40.2-12.26 40.2-29.2 0-20.3-16.1-27.49-43.1-39.3l-14.8-6.35c-42.72-18.2-71.1-41-71.1-89.2 0-44.4 33.83-78.2 86.7-78.2 37.64 0 64.7 13.1 84.2 47.4l-46.1 29.6c-10.15-18.2-21.1-25.4-38.1-25.4-17.3 0-28.3 11-28.3 25.4 0 17.7 11 25 35.5 35.5l14.8 6.34c50.3 21.6 79.9 43.6 79.9 93.9 0 54.1-42.7 82.5-97.7 82.5-54.98 0-90.5-26.2-106.9-60.9zm-180.4 1.3c9.7 17.3 18.6 31.7 39.7 31.7 20.3 0 33-8.5 33-41.4v-207.2h54.98v208.5c0 60.9-35.5 87.5-86.7 87.5-44.4 0-71.5-23.7-85.9-54.6z"/></svg>';
        case 'PhpLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 137" fill="none"><ellipse cx="128" cy="68.5" rx="128" ry="68.5" fill="#777BB4"/><path d="M72.2 42H48.4L37.1 94.6H54.2L58 77.2H68.8C80.2 77.2 87.9 71.3 90.3 60.4C92.4 50.7 86.8 42 72.2 42ZM70.4 62.8H59.5L62.7 48.2H71.2C76.8 48.2 78.8 51.5 77.8 56.1C76.9 60.3 74.4 62.8 70.4 62.8Z" fill="white"/><path d="M136.2 42H119.1L107.8 94.6H124.9L128.7 77.2H139.5C150.9 77.2 158.6 71.3 161 60.4C163.1 50.7 157.5 42 142.9 42H136.2ZM141.1 62.8H130.2L133.4 48.2H141.9C147.5 48.2 149.5 51.5 148.5 56.1C147.6 60.3 145.1 62.8 141.1 62.8Z" fill="white"/><path d="M192.5 42H175.4L164.1 94.6H181.2L185 77.2H195.8C207.2 77.2 214.9 71.3 217.3 60.4C219.4 50.7 213.8 42 199.2 42H192.5ZM197.4 62.8H186.5L189.7 48.2H198.2C203.8 48.2 205.8 51.5 204.8 56.1C203.9 60.3 201.4 62.8 197.4 62.8Z" fill="white"/></svg>';
        case 'LaravelLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 100 100" fill="none"><path d="M89.3 24.2L52.8 3.5C51.1 2.5 48.9 2.5 47.2 3.5L10.7 24.2C9 25.2 8 27 8 28.9V70.3C8 72.3 9 74.1 10.7 75.1L47.2 95.8C48.9 96.8 51.1 96.8 52.8 95.8L89.3 75.1C91 74.1 92 72.3 92 70.3V28.9C92 27 91 25.2 89.3 24.2Z" fill="#FF2D20"/><path d="M50 14L80 31.3V66L50 83.3L20 66V31.3L50 14Z" fill="white" fill-opacity="0.2"/><path d="M50 49V83.3L80 66V31.3L50 49Z" fill="white" fill-opacity="0.3"/></svg>';
        case 'NodeLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 288" fill="none"><path d="M128 0L248.8 69.8V209.3L128 279.1L7.2 209.3V69.8L128 0Z" fill="#339933"/><path d="M128 47.7L207.5 93.6V185.4L128 231.3L48.5 185.4V93.6L128 47.7Z" fill="white"/><path d="M128 73L185.5 106.2V172.8L128 206L70.5 172.8V106.2L128 73Z" fill="#339933"/></svg>';
        case 'PythonLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 255" fill="none"><path d="M126.9 0C60.7 0 64.9 28.7 64.9 28.7L65 58.4H129V67.8H38.5C4.3 67.8 0 98.7 0 98.7C0 147.1 27.6 142.3 27.6 142.3H44V119.3C44 92.5 67.9 92.5 67.9 92.5H131.7C155.8 92.5 155.8 70.8 155.8 70.8V23.6C155.8.5 126.9 0 126.9 0ZM95.3 18.2C101.4 18.2 106.3 23.2 106.3 29.3C106.3 35.4 101.4 40.3 95.3 40.3C89.2 40.3 84.3 35.4 84.3 29.3C84.3 23.2 89.2 18.2 95.3 18.2Z" fill="#3776AB"/><path d="M129.1 254.8C195.3 254.8 191.1 226.1 191.1 226.1L191 196.4H127V187H217.5C251.7 187 256 156.1 256 156.1C256 107.7 228.4 112.5 228.4 112.5H212V135.5C212 162.3 188.1 162.3 188.1 162.3H124.3C100.2 162.3 100.2 184 100.2 184V231.2C100.2 254.3 129.1 254.8 129.1 254.8ZM160.7 236.6C154.6 236.6 149.7 231.6 149.7 225.5C149.7 219.4 154.6 214.5 160.7 214.5C166.8 214.5 171.7 219.4 171.7 225.5C171.7 231.6 166.8 236.6 160.7 236.6Z" fill="#FFD43B"/></svg>';
        case 'MySqlLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 170" fill="none"><rect width="256" height="170" rx="20" fill="#00758F"/><text x="128" y="105" fill="#F29111" font-size="56" font-weight="bold" font-family="sans-serif" text-anchor="middle">MySQL</text></svg>';
        case 'MongoLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 128 276" fill="none"><path d="M63.8 0C63.8 0 54.4 34.6 54.4 79.5C54.4 135 63.8 178.5 63.8 178.5C63.8 178.5 73.3 135 73.3 79.5C73.3 34.6 63.8 0 63.8 0Z" fill="#47A248"/><path d="M63.8 0C63.8 0 4.7 48.9 0 129.2C0 196.8 54.6 250.6 63.8 276C63.8 276 54.4 200 54.4 178.5C54.4 135 63.8 0 63.8 0Z" fill="#499D4A"/><path d="M63.8 0C63.8 0 122.9 48.9 127.6 129.2C127.6 196.8 73 250.6 63.8 276C63.8 276 73.2 200 73.2 178.5C73.2 135 63.8 0 63.8 0Z" fill="#589636"/></svg>';
        case 'PostgresLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 250" fill="none"><circle cx="128" cy="125" r="120" fill="#336791"/><path d="M128 40C85 40 60 75 60 120C60 165 90 200 128 200C166 200 196 165 196 120C196 75 171 40 128 40ZM128 70C148 70 166 90 166 120C166 150 148 170 128 170C108 170 90 150 90 120C90 90 108 70 128 70Z" fill="white"/></svg>';
        case 'FlutterLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 166 202" fill="none"><path d="M102.3 0L0 102.3L31.6 133.9L165.5 0H102.3Z" fill="#02569B"/><path d="M102.3 99.8L50.4 151.7L82 183.3L133.9 131.4L102.3 99.8Z" fill="#0175C2"/><path d="M82 183.3L100.8 202.1H164L113.6 151.7L82 183.3Z" fill="#02569B"/><path d="M165.5 99.8L133.9 131.4L113.6 151.7L164 202.1H165.5V99.8Z" fill="#29B6F6"/></svg>';
        case 'AwsLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 100 60" fill="none"><text x="50" y="32" fill="#FF9900" font-size="28" font-weight="900" font-family="sans-serif" text-anchor="middle">aws</text><path d="M15 42C35 52 65 52 85 42" stroke="#FF9900" stroke-width="4" stroke-linecap="round"/><path d="M80 40L86 42L82 46" fill="#FF9900"/></svg>';
        case 'AzureLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 96 96" fill="none"><path d="M24 16L54 48L32 80H12L24 16Z" fill="#0078D4"/><path d="M54 48L42 66L56 80H84L54 48Z" fill="#50E6FF"/></svg>';
        case 'FirebaseLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 144 198" fill="none"><path d="M24.7 154.5L1.6 112.1C-0.8 107.7 2.1 102.5 7.1 102.2L68.8 98.4L24.7 154.5Z" fill="#FFA000"/><path d="M78.6 4.9C76.2 0.8 70.3 0.6 67.5 4.5L0 137.9L72 178.5L144 137.9L78.6 4.9Z" fill="#FFCA28"/><path d="M142.4 112.1L119.3 154.5L75.2 98.4L136.9 102.2C141.9 102.5 144.8 107.7 142.4 112.1Z" fill="#F57C00"/></svg>';
        case 'JavaLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 348" fill="none"><path d="M112.5 0C112.5 0 92 48 132.5 96C163.5 132.8 148.5 166.5 136.5 178.5C124.5 190.5 111 202.5 129 220.5C147 238.5 162 250.5 150 268.5C138 286.5 106.5 294 106.5 294C106.5 294 126 270 120 252C114 234 94.5 217.5 99 193.5C103.5 169.5 126 154.5 118.5 127.5C111 100.5 87 76.5 112.5 0Z" fill="#E76F00"/><path d="M60 216C60 216 102 234 148.5 216C174 205.5 198 184.5 198 184.5C198 184.5 186 199.5 160.5 211.5C120 231 75 229.5 60 216Z" fill="#5382A1"/><path d="M43.5 259.5C43.5 259.5 97.5 277.5 159 259.5C195 249 216 231 216 231C216 231 199.5 249 166.5 261C117 279 58.5 273 43.5 259.5Z" fill="#5382A1"/><path d="M129 306C72 306 31.5 292.5 31.5 292.5C31.5 292.5 67.5 306 123 306C186 306 226.5 292.5 226.5 292.5C226.5 292.5 186 306 129 306Z" fill="#5382A1"/></svg>';
        case 'RedisLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 222" fill="none"><path d="M128 0L0 55.4V166.3L128 221.7L256 166.3V55.4L128 0Z" fill="#DC382D"/><path d="M128 17.5L16.2 65.9V155.8L128 204.2L239.8 155.8V65.9L128 17.5Z" fill="#A82823"/><path d="M128 35.8L35.4 76.1L128 116.3L220.6 76.1L128 35.8Z" fill="#D8332A"/><circle cx="128" cy="85" r="14" fill="#ffffff"/></svg>';
        case 'AndroidLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 256" fill="none"><path d="M46.7 101.4C37.8 101.4 30.7 108.5 30.7 117.4V178.6C30.7 187.5 37.8 194.6 46.7 194.6C55.6 194.6 62.7 187.5 62.7 178.6V117.4C62.7 108.5 55.6 101.4 46.7 101.4ZM209.3 101.4C200.4 101.4 193.3 108.5 193.3 117.4V178.6C193.3 187.5 200.4 194.6 209.3 194.6C218.2 194.6 225.3 187.5 225.3 178.6V117.4C225.3 108.5 218.2 101.4 209.3 101.4ZM70.7 101.4V197.3C70.7 205.3 77.3 211.9 85.3 211.9H98.7V238.6C98.7 248.2 106.5 256 116.1 256C125.7 256 133.5 248.2 133.5 238.6V211.9H122.5V211.9H133.5V211.9H157.3V238.6C157.3 248.2 165.1 256 174.7 256C184.3 256 192.1 248.2 192.1 238.6V211.9H170.7C178.7 211.9 185.3 205.3 185.3 197.3V101.4H70.7ZM167.3 35.7L182.2 10C183.7 7.4 182.8 4.1 180.2 2.6C177.6 1.1 174.3 2 172.8 4.6L157.5 31C148.4 26.9 138.5 24.5 128 24.5C117.5 24.5 107.6 26.9 98.5 31L83.2 4.6C81.7 2 78.4 1.1 75.8 2.6C73.2 4.1 72.3 7.4 73.8 10L88.7 35.7C75.8 46.5 67.5 62.7 66.8 81.3H189.2C188.5 62.7 180.2 46.5 167.3 35.7ZM101.4 64C97 64 93.4 60.4 93.4 56C93.4 51.6 97 48 101.4 48C105.8 48 109.4 51.6 109.4 56C109.4 60.4 105.8 64 101.4 64ZM154.6 64C150.2 64 146.6 60.4 146.6 56C146.6 51.6 150.2 48 154.6 48C159 48 162.6 51.6 162.6 56C162.6 60.4 159 64 154.6 64Z" fill="#3DDC84"/></svg>';
        case 'IosLogo':
        case 'SwiftLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 256" fill="none"><path d="M228.8 181.7C228.6 182.1 228.3 182.5 228.1 182.8C204.3 222.8 159.9 248.8 105.1 247.9C65.5 247.3 29.5 229.4 5.3 199.9C3.1 197.2 4.6 193.1 8 192.4C26.1 188.8 45.4 180.3 60.3 167.7C62.3 166 65.2 166.5 66.8 168.6C73.4 177.3 84.1 185.3 96.5 188.9C71.3 171.1 55.4 145.4 52.8 116.8C52.4 112.5 57 109.7 60.2 112.5C73.8 124.7 94.6 136.2 116.4 139.7C93.8 117.8 82.5 87.5 86.8 57.3C87.3 53.6 91.9 51.8 94.8 54.3C124.6 79.5 168.3 130.6 179.9 174.5C189.9 157.9 194.7 137.9 192.8 117.6C192.5 114.1 196.2 111.7 199.1 113.6C227.1 132.3 234.4 163.6 228.8 181.7Z" fill="#F05138"/></svg>';
        case 'GcpLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 206" fill="none"><path d="M190.2 78.4C183.7 44.5 153.9 19 118 19C91.1 19 67.7 32.5 54 53.2C23.6 56.4 0 82.1 0 113.5C0 147.2 27.3 174.5 61 174.5H187.5C216.5 174.5 240 151 240 122C240 94.1 217.9 71.4 190.2 78.4Z" fill="#4285F4"/><path d="M118 19C128.8 19 139 21.8 147.9 26.8L129.5 58.7C126 57.3 122.1 56.5 118 56.5C89.3 56.5 66 79.8 66 108.5C66 112.4 66.4 116.2 67.3 119.8L33.7 139.2C30.7 131.2 29 122.5 29 113.5C29 64.3 68.8 24.5 118 24.5V19Z" fill="#EA4335"/><path d="M187.5 174.5H61C48.5 174.5 37 170.1 27.9 162.7L57.5 133.1C62.1 138.8 69.1 142.5 77 142.5C92.2 142.5 104.5 130.2 104.5 115C104.5 111.4 103.8 108 102.5 104.9L134.4 86.5C139.4 95.4 142.2 105.6 142.2 116.5C142.2 148.5 116.2 174.5 84.2 174.5H187.5Z" fill="#34A853"/><path d="M190.2 78.4C217.9 71.4 240 94.1 240 122C240 151 216.5 174.5 187.5 174.5V137C195.8 137 202.5 130.3 202.5 122C202.5 113.7 195.8 107 187.5 107C184.7 107 182.2 107.8 180 109.1L161.6 77.2C170.5 72.2 180.7 69.4 191.5 69.4L190.2 78.4Z" fill="#FBBC05"/></svg>';
        case 'DockerLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 189" fill="none"><path d="M251.2 84.6C243.6 78.9 231.2 78.4 220.8 82.6C218.4 72.2 212.8 62.5 204.5 55.4L195.3 64.6C200.7 70.3 204.4 77.8 205.1 86.1C194.2 88.5 182.7 94.7 175.7 103.3H11.5C5.1 103.3 0 108.4 0 114.8C0 148.6 22.4 179.6 57.3 186.2C106.6 195.5 162.7 188.8 206.8 159.2C236.4 139.3 255.4 105.7 251.2 84.6ZM59.6 94.2H83.8V70H59.6V94.2ZM88.9 94.2H113.1V70H88.9V94.2ZM118.2 94.2H142.4V70H118.2V94.2ZM59.6 64.9H83.8V40.7H59.6V64.9ZM88.9 64.9H113.1V40.7H88.9V64.9ZM118.2 64.9H142.4V40.7H118.2V64.9ZM88.9 35.6H113.1V11.4H88.9V35.6ZM118.2 35.6H142.4V11.4H118.2V35.6ZM147.5 94.2H171.7V70H147.5V94.2Z" fill="#2496ED"/></svg>';
        case 'K8sLogo':
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 256 250" fill="none"><path d="M128 0L245.9 68V204L128 272L10.1 204V68L128 0Z" fill="#326CE5"/><circle cx="128" cy="125" r="48" fill="#ffffff" fill-opacity="0.2"/><path d="M128 45V205M48 85L208 165M48 165L208 85" stroke="#ffffff" stroke-width="12" stroke-linecap="round"/></svg>';
        default:
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m10 15 5-3-5-3v6Z"/></svg>';
    }
}

/**
 * Return base set repeated sufficiently so one group spans across large screens
 */
function getMarqueeBaseSet($items, $minCount = 8) {
    if (empty($items)) return [];
    $repeatCount = max(1, (int)ceil($minCount / count($items)));
    $baseSet = [];
    for ($r = 0; $r < $repeatCount; $r++) {
        $baseSet = array_merge($baseSet, $items);
    }
    return $baseSet;
}

/**
 * Repeat array for seamless marquee scroll loop
 */
function getMarqueeSet($items, $minTotal = 12) {
    if (empty($items)) return [];
    $repeatCount = max(2, (int)ceil($minTotal / count($items)));
    $baseSet = [];
    for ($r = 0; $r < $repeatCount; $r++) {
        $baseSet = array_merge($baseSet, $items);
    }
    return array_merge($baseSet, $baseSet);
}

if (!function_exists('renderShowcaseCard')) {
    function renderShowcaseCard($tech, $catName, $extraClasses = '') {
        $displayTag = $tech['tag'] ?? $catName;
        $isFeatured = in_array($tech['name'], ['HTML5', 'CSS3']);
        $featuredClass = $isFeatured ? ' featured-tech-card' : '';
    ?>
      <div class="tech-card-item w-[310px] sm:w-[340px] md:w-[360px] shrink-0 flip-card-wrapper group cursor-pointer select-none <?php echo htmlspecialchars($extraClasses . $featuredClass); ?>">
        <div class="flip-card-inner">
          <!-- Front Face -->
          <div class="flip-card-front bg-white p-3.5 sm:p-4 rounded-2xl flex items-center gap-3.5 sm:gap-4 border-2 border-[#E2E8F0] shadow-sm group-hover:border-[#C01858] transition-all duration-300">
            <div class="w-12 h-12 sm:w-13 sm:h-13 rounded-xl bg-white border border-[#E2E8F0] flex items-center justify-center shrink-0 p-2 sm:p-2.5 shadow-xs">
              <?php echo renderTechLogo($tech['iconComponent'], 'w-full h-full object-contain'); ?>
            </div>
            <div class="overflow-hidden min-w-0 flex-1">
              <div class="flex items-center justify-between gap-1 mb-1">
                <span class="text-[10px] sm:text-xs font-bold text-[#7C3AED] bg-[#F5F3FF] border border-[#DDD6FE] px-2.5 py-0.5 rounded-full uppercase tracking-wider font-body shrink-0 truncate max-w-[170px]">
                  <?php echo htmlspecialchars($displayTag); ?>
                </span>
                <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500 shrink-0"></i>
              </div>
              <h4 class="text-sm sm:text-base font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors truncate font-heading leading-tight">
                <?php echo htmlspecialchars($tech['name']); ?>
              </h4>
              <p class="text-xs text-[#475569] truncate mt-0.5 font-medium font-body leading-normal">
                <?php echo htmlspecialchars($tech['description']); ?>
              </p>
            </div>
          </div>

          <!-- Back Face -->
          <div class="flip-card-back bg-white p-3.5 sm:p-4 rounded-2xl flex items-center justify-between gap-3 border-2 border-[#C01858] shadow-md">
            <div class="min-w-0 flex-1">
              <div class="flex items-center gap-2 mb-1.5">
                <span class="text-[10px] sm:text-xs font-bold text-[#7C3AED] bg-[#F5F3FF] border border-[#DDD6FE] px-2.5 py-0.5 rounded-full uppercase tracking-wider font-body truncate max-w-[120px]">
                  <?php echo htmlspecialchars($catName); ?>
                </span>
                <span class="text-sm sm:text-base font-bold text-[#0F172A] font-heading truncate">
                  <?php echo htmlspecialchars($tech['name']); ?>
                </span>
              </div>
              <div class="flex items-center gap-1.5 text-xs text-[#0F172A] font-semibold font-body truncate">
                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0"></i>
                <span>Production-Hardened</span>
              </div>
            </div>
            <div class="w-9 h-9 rounded-xl bg-[#FFF4EA] border border-[#FF6B00]/30 flex items-center justify-center shrink-0 text-[#FF6B00]">
              <i data-lucide="sparkles" class="w-4 h-4"></i>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
}

if (!function_exists('renderColumnHeaderCard')) {
    function renderColumnHeaderCard($title, $subTitle, $badge = '', $iconName = 'sparkles') {
    ?>
      <div class="tech-column-header-card w-full p-3 sm:p-3.5 rounded-2xl bg-gradient-to-br from-white/95 to-[#FFF7F2]/90 border border-[#FF6B00]/30 shadow-md backdrop-blur-md shrink-0 select-none">
        <div class="flex items-center gap-2.5">
          <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-[#FFF4EA] to-white border border-[#FF6B00]/30 flex items-center justify-center text-[#FF6B00] shadow-2xs shrink-0">
            <i data-lucide="<?php echo htmlspecialchars($iconName); ?>" class="w-4.5 h-4.5"></i>
          </div>
          <div class="min-w-0 flex-1">
            <?php if (!empty($badge)): ?>
              <span class="inline-block text-[8.5px] font-extrabold text-[#C01858] bg-[#FFF0F5] border border-[#C01858]/20 px-2 py-0.5 rounded-full uppercase tracking-wider mb-0.5 font-body">
                <?php echo htmlspecialchars($badge); ?>
              </span>
            <?php endif; ?>
            <h4 class="text-xs sm:text-[13px] font-black text-[#0F172A] font-heading truncate leading-tight">
              <?php echo htmlspecialchars($title); ?>
            </h4>
            <p class="text-[9.5px] text-[#475569] font-medium truncate mt-0.5">
              <?php echo htmlspecialchars($subTitle); ?>
            </p>
          </div>
        </div>
      </div>
    <?php
    }
}
