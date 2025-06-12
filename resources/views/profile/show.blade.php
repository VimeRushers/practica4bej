<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilul Meu - QGroup Investment</title>
    <style>
        :root {
            --primary-green: #94ba2a;
            --primary-green-dark: #0e411f;
            --primary-green-light: #e8f5d3;
            --secondary-blue: #3B82F6;
            --dark-gray: #1F2937;
            --medium-gray: #6B7280;
            --light-gray: #F9FAFB;
            --white: #FFFFFF;
            --border-color: #E5E7EB;
            --text-primary: #111827;
            --text-secondary: #6B7280;
            --accent-yellow: #ffd700;
            --admin-red: #DC2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #f0f9f3 100%);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
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
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .contact-info a:hover {
            color: var(--accent-yellow);
        }

        .language-selector {
            display: flex;
            gap: 1rem;
            margin-left: auto;
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
            position: sticky;
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
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            padding: 1rem 0;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
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

        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: grid;
            gap: 2rem;
        }

        .dashboard-header {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--accent-yellow) 100%);
        }

        .profile-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem;
            border: 4px solid var(--accent-yellow);
        }

        .dashboard-title {
            font-size: 2rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary-green);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-green);
        }

        .stat-icon i {
            font-size: 2.5rem;
            color: var(--primary-green);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-weight: 500;
        }

        .investment-section {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: var(--primary-green);
            font-size: 1.2rem;
        }

        .investment-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .investment-card {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .investment-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            transition: all 0.3s ease;
        }

        .investment-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .investment-card:hover::before {
            top: -30%;
            right: -30%;
        }

        .investment-type {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .investment-type i {
            color: var(--accent-yellow);
            margin-right: 0.5rem;
        }

        .investment-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-yellow);
            margin-bottom: 0.5rem;
        }

        .investment-return {
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .profile-info {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .info-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: var(--light-gray);
            border-radius: 15px;
            border-left: 5px solid var(--primary-green);
        }

        .info-section h3 {
            color: var(--text-primary);
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-primary);
        }

        .info-label i {
            color: var(--primary-green);
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }

        .info-value {
            color: var(--text-secondary);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: var(--primary-green-light);
            color: var(--primary-green-dark);
        }

        .status-verified {
            background: #cce7ff;
            color: #0056b3;
        }

        .quick-actions {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .action-button {
            display: block;
            width: 100%;
            padding: 1rem;
            margin-bottom: 1rem;
            background: var(--light-gray);
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-align: center;
        }

        .action-button i {
            margin-right: 0.5rem;
            color: var(--primary-green);
            transition: color 0.3s ease;
        }

        .action-button:hover i {
            color: var(--white);
        }

        .action-button:hover {
            background: var(--primary-green);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-button.primary {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            border: none;
        }

        .action-button.primary:hover {
            background: linear-gradient(135deg, var(--primary-green-dark) 0%, var(--primary-green) 100%);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .edit-form {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            grid-column: 1 / -1;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .form-group label i {
            color: var(--primary-green);
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(148, 186, 42, 0.1);
        }

        .password-section {
            background: var(--light-gray);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-left: 5px solid var(--accent-yellow);
        }

        .password-section h4 {
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-green-dark) 0%, var(--primary-green) 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-secondary {
            background: var(--light-gray);
            color: var(--text-primary);
            border: 2px solid var(--border-color);
        }

        .btn-secondary:hover {
            background: var(--border-color);
            transform: translateY(-2px);
        }

        .message {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .message.success {
            background: var(--primary-green-light);
            color: var(--primary-green-dark);
            border-left: 5px solid var(--primary-green);
        }

        .message.error {
            background: #ffebee;
            color: #c62828;
            border-left: 5px solid #f44336;
        }

        .hidden {
            display: none !important;
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

        .footer {
            background: var(--dark-gray);
            color: var(--white);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
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
        }
        
        .footer-section a:hover {
            color: var(--primary-green);
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
        }

        .mobile-menu-overlay.active {
            opacity: 1;
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

        .mobile-logout-btn {
            background: var(--admin-red);
            color: var(--white);
            border: none;
            cursor: pointer;
            font-family: inherit;
        }

        @media (max-width: 1200px) {
            .main-container {
                padding: 1.5rem;
            }
            
            .profile-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .investment-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .user-menu {
                display: none;
            }
        }

        @media (max-width: 768px) {
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
            
            .main-container {
                padding: 1rem;
            }

            .dashboard-header {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .dashboard-title {
                font-size: 1.8rem;
                margin-bottom: 0.5rem;
            }
            
            .dashboard-subtitle {
                font-size: 0.9rem;
            }
            
            .profile-avatar-large {
                width: 80px;
                height: 80px;
                font-size: 2rem;
                margin: 0 auto 1rem;
            }

            .profile-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .stat-card {
                padding: 1rem;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }

            .investment-cards {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .investment-card {
                padding: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .button-group {
                flex-direction: column;
                gap: 0.8rem;
            }
            
            .btn {
                padding: 1rem;
                font-size: 1rem;
                min-height: 48px;
            }

            .top-nav-content, .main-nav-content {
                padding: 0.8rem 1rem;
            }
            
            .auth-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .auth-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 0.8rem;
            }
            
            .dashboard-title {
                font-size: 1.5rem;
            }
            
            .profile-avatar-large {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }
            
            .stat-card {
                padding: 0.8rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .investment-card {
                padding: 0.8rem;
            }
            
            .mobile-menu {
                width: 100%;
                padding: 1.5rem 1rem;
            }
            
            .top-nav-content {
                padding: 0.6rem 0.8rem;
            }
            
            .logo {
                font-size: 1.2rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .investment-card {
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        <a href="{{ route('auth.register') }}" class="auth-btn register-btn">
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
                <a href="{{ route('profile') }}" class="nav-link active">Profilul Meu</a>
                @endauth
                <a href="#" class="nav-link">Portofoliul Meu</a>
                <a href="#" class="nav-link">Analize</a>
                <a href="#" class="nav-link">Contact</a>
                @auth('admin')
                <a href="/admin" class="nav-link" style="color: var(--accent-yellow); font-weight: 600;">🔐 Admin</a>
                @endauth
            </div>
            <div style="display: flex; align-items: center; gap: 1rem;">
                @auth
                <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-button">Deconectare</button>
                </form>
                @endauth
                <button class="mobile-nav-toggle" id="mobileNavToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <span class="logo">
                <img src="/images/ole_jpg.png" alt="QGroup Investment" style="height: 30px; width: auto;">
            </span>
            <button class="mobile-menu-close" id="mobileMenuClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-nav-links">
            <a href="{{ route('map') }}" class="mobile-nav-link">Hartă Investiții</a>
            @auth('web')
            <a href="{{ route('profile') }}" class="mobile-nav-link active">Profilul Meu</a>
            @endauth
            <a href="#" class="mobile-nav-link">Portofoliul Meu</a>
            <a href="#" class="mobile-nav-link">Analize</a>
            <a href="#" class="mobile-nav-link">Contact</a>
            @auth('admin')
            <a href="/admin" class="mobile-nav-link" style="color: var(--primary-green);">🔐 Admin</a>
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

    <div class="main-container">
        <div class="dashboard-header">
            <div class="profile-avatar-large">
                {{ substr($user->name, 0, 1) }}{{ substr(strstr($user->name, ' '), 1, 1) ?: substr($user->name, 1, 1) }}
            </div>
            <h1 class="dashboard-title">Bun venit, {{ $user->name }}!</h1>
            <p class="dashboard-subtitle">Investor QGroup - Energia Verde & Venituri Pasive Garantate</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-number">{{ intval($user->created_at->diffInDays()) }}</div>
                <div class="stat-label">Zile de când ești membru</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                <div class="stat-number">0</div>
                <div class="stat-label">Investiții Active</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-euro-sign"></i></div>
                <div class="stat-number">0€</div>
                <div class="stat-label">Valoare Portofoliu</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-number">0€</div>
                <div class="stat-label">Venit Lunar Estimat</div>
            </div>
        </div>

        <div class="investment-section">
            <h2 class="section-title">
                <i class="fas fa-seedling"></i>
                Oportunități de Investiție Disponibile
            </h2>
            <div class="investment-cards">
                <div class="investment-card">
                    <div class="investment-type"><i class="fas fa-industry"></i> Parcuri Fotovoltaice la Cheie</div>
                    <div class="investment-amount">Din 50.000€</div>
                    <div class="investment-return">Venit pasiv garantat • ROI: 5,3 ani • Profit lunar de la 10.000€</div>
                </div>
                <div class="investment-card">
                    <div class="investment-type"><i class="fas fa-bolt"></i> Energie Verde Comercială</div>
                    <div class="investment-amount">Din 10.000€</div>
                    <div class="investment-return">Venit lunar de la 1.000€ • Afacere fără angajați • Profit garantat</div>
                </div>
                <div class="investment-card">
                    <div class="investment-type"><i class="fas fa-home"></i> Comunități Energetice</div>
                    <div class="investment-amount">Din 25.000€</div>
                    <div class="investment-return">Investiții în grup • Securitate energetică • Dividende anuale</div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="message success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="message error">
                <i class="fas fa-exclamation-circle"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="profile-grid">
            <div class="profile-info" id="profile-view">
                <h2 class="section-title">
                    <i class="fas fa-clipboard-list"></i>
                    Informațiile Mele
                </h2>
                
                <div class="info-section">
                    <h3><i class="fas fa-user"></i> Informații Personale</h3>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-id-card"></i> Nume Complet:</span>
                        <span class="info-value">{{ $user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-at"></i> Nume de utilizator:</span>
                        <span class="info-value">{{ $user->username }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-envelope"></i> Email:</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                </div>

                <div class="info-section">
                    <h3><i class="fas fa-calendar-check"></i> Informații Cont</h3>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-user-plus"></i> Membru din:</span>
                        <span class="info-value">{{ $user->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-sync-alt"></i> Ultima actualizare:</span>
                        <span class="info-value">{{ $user->updated_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-shield-alt"></i> Status Cont:</span>
                        <span class="info-value">
                            <span class="status-badge status-active"><i class="fas fa-check"></i> Activ</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-envelope-check"></i> Email Verificat:</span>
                        <span class="info-value">
                            @if($user->email_verified_at)
                                <span class="status-badge status-verified"><i class="fas fa-check-circle"></i> Verificat</span>
                            @else
                                <span class="status-badge"><i class="fas fa-exclamation-triangle"></i> Ne-verificat</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <h3 class="section-title">
                    <i class="fas fa-bolt"></i>
                    Acțiuni Rapide
                </h3>
                
                <button type="button" class="action-button primary" onclick="toggleEditMode()">
                    <i class="fas fa-edit"></i>
                    Editează Profilul
                </button>
                
                <a href="{{ route('map') }}" class="action-button">
                    <i class="fas fa-map-marked-alt"></i>
                    Vezi Harta Investițiilor
                </a>
                
                <a href="#" class="action-button">
                    <i class="fas fa-chart-pie"></i>
                    Portofoliul Meu de Investiții
                </a>
                
                <a href="#" class="action-button">
                    <i class="fas fa-file-chart-column"></i>
                    Rapoarte & Analize
                </a>
                
                <a href="#" class="action-button">
                    <i class="fas fa-user-tie"></i>
                    Consultație Gratuită cu Expert
                </a>
                
                <a href="#" class="action-button">
                    <i class="fas fa-headset"></i>
                    Contact Direct cu Echipa
                </a>
                
                <a href="#" class="action-button">
                    <i class="fas fa-book-open"></i>
                    Ghiduri de Investiții
                </a>
            </div>
        </div>

        <div class="edit-form hidden" id="edit-form">
            <h2 class="section-title">
                <i class="fas fa-user-edit"></i>
                Editează Profilul Meu
            </h2>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Nume Complet</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Adresa Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="password-section">
                    <h4><i class="fas fa-lock"></i> Schimbă Parola (Opțional)</h4>
                    
                    <div class="form-group">
                        <label for="current_password"><i class="fas fa-key"></i> Parola Curentă</label>
                        <input type="password" id="current_password" name="current_password" placeholder="Introduceți parola curentă pentru a o schimba">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password"><i class="fas fa-unlock-alt"></i> Parola Nouă</label>
                            <input type="password" id="password" name="password" placeholder="Minimum 6 caractere">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"><i class="fas fa-check-double"></i> Confirmă Parola Nouă</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Reintroduceți parola nouă">
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvează Modificările
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEditMode()">
                        <i class="fas fa-times"></i> Anulează
                    </button>
                </div>
            </form>
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
        function toggleEditMode() {
            const profileView = document.getElementById('profile-view');
            const editForm = document.getElementById('edit-form');
            const quickActions = document.querySelector('.quick-actions');
            
            if (profileView.classList.contains('hidden')) {
                profileView.classList.remove('hidden');
                editForm.classList.add('hidden');
                quickActions.style.display = 'block';
            } else {
                profileView.classList.add('hidden');
                editForm.classList.remove('hidden');
                quickActions.style.display = 'none';
                
                document.getElementById('name').focus();
            }
        }

        setTimeout(function() {
            const successMessages = document.querySelectorAll('.message.success');
            successMessages.forEach(function(message) {
                message.style.opacity = '0';
                setTimeout(function() {
                    message.style.display = 'none';
                }, 300);
            });
        }, 5000);

        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            const investmentCards = document.querySelectorAll('.investment-card');
            
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            investmentCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.02)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileNavToggle = document.getElementById('mobileNavToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            const mobileMenuClose = document.getElementById('mobileMenuClose');
            
            function openMobileMenu() {
                mobileMenu.classList.add('active');
                mobileMenuOverlay.classList.add('active');
                mobileMenuOverlay.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
            
            function closeMobileMenu() {
                mobileMenu.classList.remove('active');
                mobileMenuOverlay.classList.remove('active');
                setTimeout(() => {
                    mobileMenuOverlay.style.display = 'none';
                }, 300);
                document.body.style.overflow = '';
            }
            
            if (mobileNavToggle) {
                mobileNavToggle.addEventListener('click', openMobileMenu);
            }
            
            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', closeMobileMenu);
            }
            
            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', closeMobileMenu);
            }
            
            const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
            mobileNavLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
            
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeMobileMenu();
                }
            });
        });
    </script>
</body>
</html>
