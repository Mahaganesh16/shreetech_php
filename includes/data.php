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
    'address' => '500 Howard St, Suite 400, San Francisco, CA 94105',
    'copyright' => '© ' . date('Y') . ' Shree Tech Innovations Inc. All rights reserved.'
];

$navLinks = [
    ['label' => 'Home', 'href' => 'index.php', 'page' => 'home'],
    ['label' => 'About', 'href' => 'about.php', 'page' => 'about'],
    ['label' => 'Services', 'href' => 'services.php', 'page' => 'services'],
    ['label' => 'Technologies', 'href' => 'technologies.php', 'page' => 'technologies'],
    ['label' => 'Projects', 'href' => 'projects.php', 'page' => 'projects'],
    ['label' => 'Contact', 'href' => 'contact.php', 'page' => 'contact'],
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
        'title' => 'Apex Institutional FinTech Portal',
        'category' => 'web',
        'categoryLabel' => 'Web Application',
        'client' => 'Apex Financial Markets',
        'year' => '2025',
        'summary' => 'A unified high-speed institutional trading and risk-management terminal with sub-second WebSocket telemetry, multi-currency routing, and automated compliance verification.',
        'technologies' => ['Next.js', 'TypeScript', 'Node.js', 'PostgreSQL', 'Tailwind CSS'],
        'imageUrl' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
        'layoutSpan' => 'featured',
        'metrics' => ['label' => 'Daily Trading Volume', 'value' => '$45M+']
    ],
    [
        'id' => 'health-cloud',
        'title' => 'CareSync Telemedicine & EHR Suite',
        'category' => 'enterprise',
        'categoryLabel' => 'Enterprise SaaS',
        'client' => 'CareSync Health Network',
        'year' => '2025',
        'summary' => 'HIPAA-compliant patient record exchange and secure video consultation infrastructure linking 12,000 clinicians across regional hospitals.',
        'technologies' => ['React', 'Python', 'AWS', 'Docker', 'PostgreSQL'],
        'imageUrl' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Patients Managed', 'value' => '350,000+']
    ],
    [
        'id' => 'fleet-mobile',
        'title' => 'Veloce Logistics Driver & Dispatch App',
        'category' => 'mobile',
        'categoryLabel' => 'Mobile Application',
        'client' => 'Veloce Freight Systems',
        'year' => '2024',
        'summary' => 'Cross-platform mobile application providing real-time GPS telemetry, offline route caching, proof-of-delivery signatures, and automated dispatch rebalancing.',
        'technologies' => ['Flutter', 'Firebase', 'Node.js', 'MongoDB', 'REST APIs'],
        'imageUrl' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Route Efficiency Gain', 'value' => '+34%']
    ],
    [
        'id' => 'luxury-commerce',
        'title' => 'Aura Luxury Headless Storefront',
        'category' => 'web',
        'categoryLabel' => 'E-Commerce',
        'client' => 'Maison Aura Paris',
        'year' => '2025',
        'summary' => 'International multi-currency headless e-commerce experience with sub-second page loads, global CDN edge caching, and localized checkout in 32 markets.',
        'technologies' => ['Next.js', 'Shopify Plus API', 'TypeScript', 'Tailwind CSS'],
        'imageUrl' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?auto=format&fit=crop&w=800&q=80',
        'layoutSpan' => 'standard',
        'metrics' => ['label' => 'Conversion Lift', 'value' => '+42%']
    ],
    [
        'id' => 'cloud-security',
        'title' => 'Zero-Trust Cloud Governance Platform',
        'category' => 'cloud',
        'categoryLabel' => 'Cloud Infrastructure',
        'client' => 'Nordic Hosting AB',
        'year' => '2024',
        'summary' => 'Multi-cloud monitoring dashboard consolidating AWS and Azure cluster telemetry with proactive intrusion mitigation and audit trail compliance.',
        'technologies' => ['React', 'Go', 'Kubernetes', 'AWS', 'Azure'],
        'imageUrl' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1200&q=80',
        'layoutSpan' => 'featured',
        'metrics' => ['label' => 'Infrastructure Uptime', 'value' => '99.999%']
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
        'description' => 'Modern, high-performance UI frameworks delivering accessible, responsive, and reactive web applications.',
        'items' => [
            ['name' => 'React.js', 'description' => 'Declarative component-driven interfaces', 'iconComponent' => 'ReactLogo'],
            ['name' => 'Next.js', 'description' => 'Server-side rendering & App Router', 'iconComponent' => 'NextLogo'],
            ['name' => 'HTML5', 'description' => 'Semantic, accessible markup standards', 'iconComponent' => 'HtmlLogo'],
            ['name' => 'CSS3', 'description' => 'Responsive design & modern layouts', 'iconComponent' => 'CssLogo'],
            ['name' => 'JavaScript', 'description' => 'ESNext interactive web scripting', 'iconComponent' => 'JavaScriptLogo'],
        ]
    ],
    [
        'category' => 'Backend',
        'description' => 'Resilient server runtimes and enterprise frameworks built for high concurrency and robust data handling.',
        'items' => [
            ['name' => 'Node.js', 'description' => 'Event-driven asynchronous backend services', 'iconComponent' => 'NodeLogo'],
            ['name' => 'Python', 'description' => 'Data processing, APIs, and AI automation', 'iconComponent' => 'PythonLogo'],
            ['name' => 'Laravel', 'description' => 'Full-featured enterprise PHP web framework', 'iconComponent' => 'LaravelLogo'],
            ['name' => 'PHP', 'description' => 'Battle-tested server-side web scripting', 'iconComponent' => 'PhpLogo'],
        ]
    ],
    [
        'category' => 'Database',
        'description' => 'Relational, document, and analytical databases engineered for data integrity and high transaction throughput.',
        'items' => [
            ['name' => 'PostgreSQL', 'description' => 'Advanced open-source relational database', 'iconComponent' => 'PostgresLogo'],
            ['name' => 'MySQL', 'description' => 'High-reliability transactional relational DB', 'iconComponent' => 'MySqlLogo'],
            ['name' => 'MongoDB', 'description' => 'Document-based flexible NoSQL database', 'iconComponent' => 'MongoLogo'],
        ]
    ],
    [
        'category' => 'Mobile',
        'description' => 'Cross-platform native mobile frameworks delivering fluid 60FPS experiences for iOS and Android.',
        'items' => [
            ['name' => 'Flutter', 'description' => 'Google native multi-platform compilation', 'iconComponent' => 'FlutterLogo'],
            ['name' => 'React Native', 'description' => 'Native mobile components powered by React', 'iconComponent' => 'ReactNativeLogo'],
        ]
    ],
    [
        'category' => 'Cloud',
        'description' => 'Secure, elastic cloud hosting and serverless infrastructures engineered for zero downtime.',
        'items' => [
            ['name' => 'AWS', 'description' => 'Global cloud infrastructure & services', 'iconComponent' => 'AwsLogo'],
            ['name' => 'Azure', 'description' => 'Enterprise cloud computing & hybrid solutions', 'iconComponent' => 'AzureLogo'],
            ['name' => 'Firebase', 'description' => 'Real-time database, auth & cloud functions', 'iconComponent' => 'FirebaseLogo'],
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
        default:
            return '<svg class="' . htmlspecialchars($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="m10 15 5-3-5-3v6Z"/></svg>';
    }
}

/**
 * Repeat array for seamless marquee scroll loop
 */
function getMarqueeSet($items, $minTotal = 12) {
    if (empty($items)) return [];
    $repeatCount = max(2, ceil($minTotal / count($items)));
    $baseSet = [];
    for ($r = 0; $r < $repeatCount; $r++) {
        $baseSet = array_merge($baseSet, $items);
    }
    return array_merge($baseSet, $baseSet);
}
