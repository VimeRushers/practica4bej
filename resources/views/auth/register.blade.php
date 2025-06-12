<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare - QGroup Investment</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-green: #94ba2a;
            --primary-green-dark: #0e411f;
            --primary-green-light: #e8f5d3;
            --accent-yellow: #ffd700;
            --white: #FFFFFF;
            --light-gray: #F9FAFB;
            --border-color: #E5E7EB;
            --text-primary: #111827;
            --text-secondary: #6B7280;
            --dark-gray: #1F2937;
            --admin-red: #DC2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(249, 215, 28, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(148, 186, 42, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 1;
        }

        .top-bar {
            background: var(--dark-gray);
            color: var(--white);
            padding: 0.5rem 0;
            position: relative;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1001;
            font-size: 0.875rem;
        }

        .top-bar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            min-height: 40px;
        }

        .contact-info {
            display: flex;
            gap: 1.5rem;
        }

        .contact-info a {
            color: var(--white);
            text-decoration: none;
            transition: color 0.3s;
        }

        .contact-info a:hover {
            color: var(--accent-yellow);
        }

        .language-selector {
            display: flex;
            gap: 1rem;
            margin-left: auto;
            align-items: center;
        }

        .language-selector a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.875rem;
            min-width: 40px;
            text-align: center;
            display: inline-block;
        }

        .language-selector a.active,
        .language-selector a:hover {
            color: var(--accent-yellow);
            background: rgba(249, 215, 28, 0.1);
        }

        .top-nav {
            background: var(--white);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            top: 0;
            z-index: 1000;
        }

        .top-nav-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-green);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 1rem;
            background: var(--primary-green-light);
            border-radius: 50px;
            border: 2px solid var(--primary-green);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .main-nav {
            background: var(--primary-green);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 999;
        }

        .main-nav-content {
            max-width: 1200px;
            height: 4rem;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            position: relative;
            z-index: 999;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            padding: 1rem 0;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            pointer-events: auto;
        }

        .nav-link:hover, .nav-link.active {
            border-bottom-color: var(--accent-yellow);
            color: var(--accent-yellow);
        }

        .logout-button {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background: var(--white);
            color: var(--primary-green);
        }

        .admin-logout-btn {
            background: rgba(220, 38, 38, 0.2);
            color: var(--white);
            border: 2px solid rgba(220, 38, 38, 0.3);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            backdrop-filter: blur(10px);
        }

        .admin-logout-btn:hover {
            background: var(--admin-red);
            border-color: var(--admin-red);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }

        .admin-logout-btn i {
            font-size: 0.875rem;
        }


        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .auth-btn {
            padding: 0.75rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .login-btn {
            background: rgba(148, 186, 42, 0.1);
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
        }

        .register-btn {
            background: var(--primary-green);
            color: var(--white);
            border: 2px solid var(--primary-green);
        }

        .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
        }

        .auth-btn.active {
            background: var(--primary-green);
            color: var(--white);
        }

        .main-content {
            display: flex;
            min-height: 100vh;
            padding-top: 0;
            position: relative;
            z-index: 2;
        }

        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: var(--white);
            text-align: center;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-content .highlight {
            color: var(--accent-yellow);
        }

        .hero-content p {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto 2rem auto;
            font-weight: 300;
            line-height: 1.6;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
            pointer-events: auto;
            cursor: pointer;
            position: relative;
            z-index: 15;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(148, 186, 42, 0.4);
        }

        .right-section {
            flex: 0 0 550px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-container {
            background: var(--white);
            border-radius: 24px;
            padding: 50px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
            position: relative;
            z-index: 3;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            max-height: 90vh;
            overflow-y: auto;
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
        }

        .register-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .register-header .subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: var(--white);
            color: var(--text-primary);
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(148, 186, 42, 0.1);
            transform: translateY(-1px);
        }

        .btn {
            padding: 15px 25px;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
            font-family: inherit;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(148, 186, 42, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
        }

        .login-link a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: var(--primary-green-dark);
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid #dc2626;
            font-weight: 500;
        }

        .success-message {
            background: var(--primary-green-light);
            color: var(--primary-green-dark);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-green);
            font-weight: 500;
        }

        .back-to-map {
            position: fixed;
            top: 140px;
            left: 20px;
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-green);
            padding: 12px 24px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 1002;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-to-map:hover {
            background: white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: var(--primary-green-dark);
            transform: translateY(-2px);
        }

        .notice {
            background: var(--primary-green-light);
            color: var(--primary-green-dark);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-green);
            font-weight: 500;
            text-align: center;
        }

        .footer {
            background: var(--dark-gray);
            color: var(--white);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
            position: relative;
            z-index: 10;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            color: var(--primary-green);
            font-size: 1.125rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .footer-section p,
        .footer-section a {
            color: #9CA3AF;
            text-decoration: none;
            line-height: 1.6;
            transition: color 0.3s;
            pointer-events: auto;
            cursor: pointer;
        }
        
        .footer-section a:hover {
            color: var(--primary-green);
            text-decoration: underline;
        }
        
        .footer-section p a {
            color: inherit;
            transition: all 0.3s ease;
        }
        
        .footer-section p a:hover {
            color: var(--primary-green);
            transform: translateX(2px);
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 0.5rem;
        }
        
        .footer-bottom {
            border-top: 1px solid #374151;
            padding-top: 1.5rem;
            text-align: center;
            color: #6B7280;
            font-size: 0.875rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(148, 186, 42, 0.1);
            border-radius: 8px;
            color: var(--primary-green);
            transition: all 0.3s;
        }
        
        .social-links a:hover {
            background: var(--primary-green);
            color: var(--white);
            transform: translateY(-2px);
        }
        

        .mobile-nav-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001;
        }

        .mobile-nav-toggle:hover {
            color: var(--accent-yellow);
        }

        .mobile-menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 280px;
            height: 100vh;
            background: var(--white);
            z-index: 1001;
            transition: right 0.3s ease;
            padding: 2rem 1rem;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .mobile-menu.active {
            right: 0;
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .mobile-menu-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-primary);
            cursor: pointer;
            padding: 0.5rem;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .mobile-nav-link {
            color: var(--text-primary);
            text-decoration: none;
            padding: 1rem 0;
            font-weight: 500;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            color: var(--primary-green);
            padding-left: 1rem;
        }

        .mobile-auth-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .mobile-auth-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .mobile-auth-btn {
            padding: 1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }

        .mobile-login-btn {
            background: var(--primary-green-light);
            color: var(--primary-green);
            border: 2px solid var(--primary-green);
        }

        .mobile-register-btn {
            background: var(--primary-green);
            color: var(--white);
        }

        .mobile-logout-btn {
            background: var(--admin-red);
            color: var(--white);
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        @media (min-width: 1201px) {
            .main-content {
                min-height: calc(100vh - 140px);
            }
            
            .left-section {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 4rem 3rem;
                min-height: calc(100vh - 140px);
            }
            
            .hero-content {
                max-width: 700px;
                margin: 0 auto;
                text-align: center;
            }
            
            .hero-content h1 {
                font-size: 4rem;
                line-height: 1.1;
                margin-bottom: 2rem;
            }
            
            .hero-content p {
                font-size: 1.35rem;
                line-height: 1.6;
                margin-bottom: 2.5rem;
            }
            
            .right-section {
                flex: 0 0 600px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 4rem 2rem;
                min-height: calc(100vh - 140px);
            }
        }
        
        @media (max-width: 1200px) {
            .main-content {
                flex-direction: column;
            }
            
            .left-section, .right-section {
                flex: none;
                padding: 1.5rem;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 1024px) {
            .user-menu {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .top-bar {
                padding: 0.4rem 0;
            }
            
            .top-bar-container {
                padding: 0 1rem;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .contact-info {
                gap: 1rem;
                flex-wrap: wrap;
            }
            
            .contact-info a {
                font-size: 0.8rem;
            }
            
            .language-selector {
                gap: 0.5rem;
            }
            
            .top-nav-content {
                padding: 0.8rem 1rem;
            }
            
            .logo {
                font-size: 1.3rem;
            }
            
            .user-menu {
                display: none;
            }
            
            .main-nav-content {
                padding: 0 1rem;
                position: relative;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-nav-toggle {
                display: block;
            }
            
            .auth-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .auth-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .main-content {
                flex-direction: column;
                padding-top: 0;
                min-height: calc(100vh - 140px);
            }
            
            .left-section {
                padding: 2rem 1rem;
                min-height: 50vh;
            }
            
            .hero-content h1 {
                font-size: 2rem;
                margin-bottom: 1rem;
            }
            
            .hero-content p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .cta-button {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
            
            .right-section {
                flex: none;
                padding: 1rem;
            }
            
            .register-container {
                padding: 30px 25px;
                max-width: 100%;
                margin: 0;
                border-radius: 16px;
            }
            
            .form-control {
                padding: 1rem;
                font-size: 1rem;
            }
            
            .btn {
                padding: 1rem;
                font-size: 1rem;
                min-height: 48px;
            }
            
            .back-to-map {
                position: relative;
                top: auto;
                left: auto;
                display: block;
                width: fit-content;
                margin: 1rem auto;
            }
        }

        @media (max-width: 480px) {
            .top-bar-container {
                flex-direction: column;
                gap: 0.5rem;
                padding: 0.5rem;
            }
            
            .contact-info {
                justify-content: center;
                gap: 0.5rem;
            }
            
            .language-selector {
                justify-content: center;
            }
            
            .top-nav-content {
                padding: 0.6rem 0.8rem;
            }
            
            .logo {
                font-size: 1.2rem;
            }
            
            .mobile-menu {
                width: 100%;
            }
            
            .hero-content h1 {
                font-size: 1.8rem;
            }
            
            .hero-content p {
                font-size: 0.95rem;
            }
            
            .register-container {
                padding: 20px 15px;
                border-radius: 12px;
            }
            
            .form-control {
                padding: 0.9rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="top-bar-container">
            <div class="language-selector">
                <a href="#" class="active">RO</a>
                <a href="#">EN</a>
                <a href="#">RU</a>
            </div>
        </div>
    </div>

    <div class="top-nav">
        <div class="top-nav-content">
            <a href="{{ route('map') }}" class="logo">
                <img src="/images/ole_jpg.png" alt="QGroup Investment" style="height: 4rem; width: auto;">
            </a>
            <div class="user-menu">
                @if(Auth::guard('web')->check())
                    <div class="user-info">
                        <div class="user-avatar">
                            {{ substr(Auth::guard('web')->user()->name, 0, 1) }}{{ substr(strstr(Auth::guard('web')->user()->name, ' '), 1, 1) ?: substr(Auth::guard('web')->user()->name, 1, 1) }}
                        </div>
                        <span>{{ Auth::guard('web')->user()->name }}</span>
                    </div>
                @elseif(Auth::guard('admin')->check())
                    <div class="user-info" style="background: linear-gradient(135deg, var(--admin-red), #b91c1c); border-color: var(--admin-red);">
                        <div class="user-avatar" style="background: var(--admin-red);">
                            {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}{{ substr(strstr(Auth::guard('admin')->user()->name, ' '), 1, 1) ?: substr(Auth::guard('admin')->user()->name, 1, 1) }}
                        </div>
                        <span style="color: white;">{{ Auth::guard('admin')->user()->name }} (Admin)</span>
                    </div>
                    <form action="{{ route('auth.logout') }}" method="POST" style="display: inline; margin-left: 1rem;">
                        @csrf
                        <button type="submit" class="admin-logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Deconectare Admin
                        </button>
                    </form>
                @else
                    <div class="auth-buttons">
                        <a href="{{ route('auth.login') }}" class="auth-btn login-btn">
                            <i class="fas fa-sign-in-alt"></i>
                            Conectare
                        </a>
                        <a href="{{ route('auth.register') }}" class="auth-btn register-btn active">
                            <i class="fas fa-user-plus"></i>
                            Înregistrare
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="main-nav">
        <div class="main-nav-content">
            <div class="nav-links">
                <a href="{{ route('map') }}" class="nav-link">Hartă Investiții</a>
                @auth('web')
                <a href="{{ route('profile') }}" class="nav-link">Profilul Meu</a>
                @endauth
                <a href="#" class="nav-link">Portofoliul Meu</a>
                <a href="#" class="nav-link">Analize</a>
                <a href="#" class="nav-link">Contact</a>
                @auth('admin')
                <a href="/admin" class="nav-link" style="color: var(--accent-yellow); font-weight: 600;">🔐 Admin</a>
                @endauth
            </div>
            <button class="mobile-nav-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
            @auth
            <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">Deconectare</button>
            </form>
            @endauth
        </div>
    </div>

    <div class="mobile-menu-overlay" onclick="closeMobileMenu()"></div>

    <div class="mobile-menu">
        <div class="mobile-menu-header">
            <div class="logo">
                <img src="/images/ole_jpg.png" alt="QGroup Investment" style="height: 30px; width: auto;">
            </div>
            <button class="mobile-menu-close" onclick="closeMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-nav-links">
            <a href="{{ route('map') }}" class="mobile-nav-link">Hartă Investiții</a>
            @auth('web')
            <a href="{{ route('profile') }}" class="mobile-nav-link">Profilul Meu</a>
            @endauth
            <a href="#" class="mobile-nav-link">Portofoliul Meu</a>
            <a href="#" class="mobile-nav-link">Analize</a>
            <a href="#" class="mobile-nav-link">Contact</a>
            @auth('admin')
            <a href="/admin" class="mobile-nav-link">🔐 Admin</a>
            @endauth
        </div>
        
        @guest
        <div class="mobile-auth-section">
            <div class="mobile-auth-buttons">
                <a href="{{ route('auth.login') }}" class="mobile-auth-btn mobile-login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Conectare
                </a>
                <a href="{{ route('auth.register') }}" class="mobile-auth-btn mobile-register-btn">
                    <i class="fas fa-user-plus"></i>
                    Înregistrare
                </a>
            </div>
        </div>
        @endguest
        
        @auth
        <div class="mobile-auth-section">
            <form action="{{ route('auth.logout') }}" method="POST">
                @csrf
                <button type="submit" class="mobile-auth-btn mobile-logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Deconectare
                </button>
            </form>
        </div>
        @endauth
    </div>

    <div class="main-content">
        <div class="left-section">
            <div class="hero-content">
                <h1>
                    Alătură-te
                    <span class="highlight">Comunității</span>
                    de Investitori
                </h1>
                <p>
                    Creează-ți contul și descoperă oportunități exclusive de investiții în Moldova. 
                    Accesează analize detaliate, rapoarte de piață și conectează-te cu alți investitori din regiune.
                </p>
                <a href="{{ route('map') }}" class="cta-button">
                    <i class="fas fa-map-marked-alt"></i>
                    Explorează Harta
                </a>
            </div>
        </div>

        <div class="right-section">
            <div class="register-container">
                <div class="register-header">
                    <h1>
                        <i class="fas fa-user-plus"></i>
                        Înregistrare
                    </h1>
                    <p class="subtitle">Creează-ți contul de utilizator</p>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-id-card"></i>
                            Nume complet
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-control"
                            value="{{ old('name') }}" 
                            placeholder="Introdu numele complet"
                            required 
                            autofocus
                        >
                    </div>

                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-user"></i>
                            Nume utilizator
                        </label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control"
                            value="{{ old('username') }}" 
                            placeholder="Alege un nume de utilizator"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            Adresă email
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control"
                            value="{{ old('email') }}" 
                            placeholder="introdu@email.com"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i>
                            Parolă
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control"
                            placeholder="Alege o parolă sigură"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">
                            <i class="fas fa-lock"></i>
                            Confirmă parola
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="form-control"
                            placeholder="Confirmă parola"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i>
                        Creează contul
                    </button>
                </form>

                <div class="login-link">
                    <p>Ai deja un cont?</p>
                    <a href="{{ route('auth.login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Conectează-te aici
                    </a>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>QGroup</h3>
                    <p>Lideri în dezvoltarea proiectelor de energie regenerabilă în Moldova. Oferim soluții complete pentru investiții în parcuri fotovoltaice.</p>
                    <div class="social-links">
                        <a href="https://www.youtube.com/user/VideoSecurityCompany" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://www.instagram.com/qgroup.moldova/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://t.me/darconf_bot" target="_blank" title="Telegram"><i class="fab fa-telegram"></i></a>
                        <a href="https://www.linkedin.com/company/qgroup-moldova" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100087474230980" target="_blank" title="Facebook"><i class="fab fa-facebook"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Servicii</h3>
                    <ul>
                        <li><a href="{{ route('map') }}">Parcuri Fotovoltaice</a></li>
                        <li><a href="{{ route('map') }}">Consultanță Investiții</a></li>
                        <li><a href="{{ route('map') }}">Management Proiecte</a></li>
                        <li><a href="{{ route('map') }}">Servicii Complete</a></li>
                        <li><a href="{{ route('map') }}">Suport Tehnic</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Pentru Investitori</h3>
                    <ul>
                        <li><a href="{{ route('map') }}">Oportunități Investiții</a></li>
                        <li><a href="{{ route('map') }}">Granturi Disponibile</a></li>
                        <li><a href="{{ route('map') }}">ROI Calculator</a></li>
                        <li><a href="{{ route('map') }}">Studii de Caz</a></li>
                        <li><a href="{{ route('map') }}">Rapoarte Financiare</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p><a href="mailto:investor@qgroup.md"><i class="fas fa-envelope"></i> investor@qgroup.md</a></p>
                    <p><a href="tel:+37378940400"><i class="fas fa-phone"></i> +373 78 940 400</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> Chișinău, Moldova</p>
                    <a href="mailto:investor@qgroup.md?subject=Solicitare%20apel&body=Doresc%20să%20vorbesc%20cu%20un%20consultant%20pentru%20oportunități%20de%20investiții." class="cta-button" style="margin-top: 1rem; display: inline-flex;">
                        Solicitați un apel
                    </a>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 QGroup. Toate drepturile rezervate.</p>
                <p style="margin-top: 0.5rem; font-size: 0.75rem; opacity: 0.7;">
                </p>
            </div>
        </div>
    </footer>
    <script>
        function toggleMobileMenu() {
            const overlay = document.querySelector('.mobile-menu-overlay');
            const menu = document.querySelector('.mobile-menu');
            
            overlay.style.display = 'block';
            menu.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            const overlay = document.querySelector('.mobile-menu-overlay');
            const menu = document.querySelector('.mobile-menu');
            
            menu.classList.remove('active');
            overlay.classList.remove('active');
            
            setTimeout(() => {
                overlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 300);
        }

        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Footer button debugging loaded');
            
            const footerLinks = document.querySelectorAll('.footer a');
            footerLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    console.log('Footer link clicked:', this.href);
                    console.log('Link element:', this);
                });
            });
            
            const footer = document.querySelector('.footer');
            if (footer) {
                console.log('Footer found, z-index:', window.getComputedStyle(footer).zIndex);
                console.log('Footer pointer-events:', window.getComputedStyle(footer).pointerEvents);
            }
        });
    </script>
</body>
</html>
