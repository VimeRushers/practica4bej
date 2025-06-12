<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Panou Admin - QGroup Investment Puncte</title>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #f0f9f3 100%);
            color: var(--text-primary);
            line-height: 1.6;
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
            background: linear-gradient(135deg, var(--admin-red), #b91c1c);
            border-radius: 50px;
            border: 2px solid var(--admin-red);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--admin-red);
            color: var(--white);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
        }

        .user-info span {
            color: white;
            font-weight: 500;
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
            background: var(--admin-red);
            color: var(--white);
            border: 2px solid var(--admin-red);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
        }

        .admin-logout-btn:hover {
            background: #b91c1c;
            border-color: #b91c1c;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
        }

        .admin-logout-btn i {
            font-size: 0.875rem;
        }


        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .auth-btn {
            padding: 0.5rem 1rem;
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
            width: 100vw;
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
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        .nav-menu a {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }
        
        .nav-menu a:hover {
            color: var(--primary-green);
        }
        
        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary-green);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--admin-red), #b91c1c);
            border-radius: 50px;
            color: white;
            font-weight: 500;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--admin-red);
            font-weight: 600;
        }
        
        .logout-btn {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .admin-header {
            background: linear-gradient(135deg, var(--admin-red) 0%, #B91C1C 100%);
            color: var(--white);
            padding: 2rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .admin-header-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            padding: 0 2rem;
        }
        
        .admin-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .admin-header p {
            font-size: 1.125rem;
            opacity: 0.95;
            font-weight: 300;
        }
        
        .admin-header .admin-logout-btn {
            background: var(--admin-red);
            color: var(--white);
            border: 2px solid var(--admin-red);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
        }
        
        .admin-header .admin-logout-btn:hover {
            background: #b91c1c;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
        }
        
        .admin-header .admin-logout-btn i {
            font-size: 1rem;
        }
        
        .admin-nav {
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }
        
        .admin-nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-nav .logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--admin-red);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .admin-nav .back-to-map {
            background: var(--primary-green);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .admin-nav .back-to-map:hover {
            background: var(--primary-green-dark);
            transform: translateY(-2px);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            background: var(--admin-red);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 14px;
        }

        .logout-btn:hover {
            background: #B91C1C;
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            gap: 2rem;
            min-height: calc(100vh - 300px);
        }
        
        .sidebar {
            width: 400px;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            height: fit-content;
            border: 1px solid var(--border-color);
        }
        
        .map-container {
            flex: 1;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border-color);
            min-height: 600px;
        }
        
        #map {
            height: 100%;
            width: 100%;
            border-radius: 20px;
        }
        
        .section {
            margin-bottom: 2rem;
        }
        
        .section:last-child {
            margin-bottom: 0;
        }
        
        .section h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--admin-red);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section h2 i {
            color: var(--admin-red);
        }
        
        .section h2 .waypoints-count {
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 400;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.3s;
        }
        
        .form-group.focused label {
            color: var(--admin-red);
        }
        
        .form-control {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s;
            background: var(--white);
            color: var(--text-primary);
            position: relative;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--admin-red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
            transform: translateY(-1px);
        }
        
        .form-control:valid {
            border-color: var(--primary-green);
        }
        
        .btn {
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .btn-admin {
            background: linear-gradient(135deg, var(--admin-red) 0%, #B91C1C 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-success:hover::before {
            left: 100%;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(148, 186, 42, 0.4);
            border-color: var(--primary-green);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }
        
        .btn-danger::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-danger:hover::before {
            left: 100%;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            border-color: #EF4444;
        }
        
        .btn-block {
            width: 100%;
        }
        
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .coordinates-display {
            background: var(--light-gray);
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 1rem;
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 0.875rem;
            color: var(--text-secondary);
            text-align: center;
            transition: all 0.3s;
        }
        
        .coordinates-display.active {
            border-color: var(--admin-red);
            background: rgba(220, 38, 38, 0.05);
            color: var(--admin-red);
        }
        
        .instructions {
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(220, 38, 38, 0.05) 100%);
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 12px;
            padding: 1.25rem;
            color: var(--admin-red);
            font-size: 0.95rem;
            line-height: 1.6;
            position: relative;
            padding-left: 3rem;
        }
        
        .instructions::before {
            content: '🔒';
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.25rem;
        }
        
        .waypoint-item {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem;
            margin: 0 0 0.75rem 0;
            transition: all 0.3s ease;
            position: relative;
            box-sizing: border-box;
            overflow: hidden;
            display: block;
            width: 100%;
            animation: slideInFromLeft 0.3s ease-out;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transform: translateZ(0);  
            backface-visibility: hidden; 
        }
        
        .waypoint-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(135deg, var(--admin-red) 0%, #B91C1C 100%);
            border-radius: 4px 0 0 4px;
        }
        
        .waypoint-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            border-color: var(--admin-red);
        }
        
        .waypoint-name {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-left: 0.25rem;
        }
        
        .waypoint-coords {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            font-family: 'Monaco', 'Menlo', monospace;
            background: rgba(220, 38, 38, 0.08);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            display: inline-block;
            margin-left: 0.25rem;
        }
        
        .waypoint-description {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            line-height: 1.4;
            max-height: 3.2em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            padding-left: 0.25rem;
        }
        
        .waypoint-actions {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            padding-left: 0.25rem;
        }
        
        .waypoint-actions .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            min-width: 80px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }
        
        .waypoint-actions .btn-sm:hover {
            transform: translateY(-1px);
        }
        
        .waypoint-actions .btn-success {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(148, 186, 42, 0.25);
        }
        
        .waypoint-actions .btn-success:hover {
            box-shadow: 0 4px 12px rgba(148, 186, 42, 0.35);
            background: linear-gradient(135deg, var(--primary-green-dark) 0%, var(--primary-green) 100%);
        }
        
        .waypoint-actions .btn-danger {
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.25);
        }
        
        .waypoint-actions .btn-danger:hover {
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35);
            background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
        }
        
        .search-container {
            margin-bottom: 1rem;
        }
        
        .search-box {
            position: relative;
            background: linear-gradient(135deg, var(--white) 0%, rgba(220, 38, 38, 0.03) 100%);
            border: 2px solid var(--border-color);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
            transform: translateZ(0); 
            backface-visibility: hidden; 
        }
        
        .search-box:focus-within {
            border-color: var(--admin-red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            z-index: 5;
        }
        
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: none;
            outline: none;
            font-size: 0.9rem;
            color: var(--text-primary);
            background: transparent;
            box-shadow: none;
        }
        
        .search-input::placeholder {
            color: var(--text-secondary);
        }
        
        .clear-search {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            opacity: 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            z-index: 10;
        }
        
        .clear-search:hover {
            background: rgba(220, 38, 38, 0.1);
            color: var(--admin-red);
        }
        
        .search-box.has-content .clear-search {
            opacity: 1;
        }
        
        .waypoints-container {
            max-height: 240px;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0.5rem 0;
            margin: 0;
            background: transparent;
            border-radius: 8px;
            position: relative;
            transform: translateZ(0); 
            backface-visibility: hidden; 
        }
        
        .waypoints-container::after {
            content: '';
            position: sticky;
            bottom: 0;
            display: block;
            height: 15px;
            background: linear-gradient(transparent, var(--light-gray));
            pointer-events: none;
            margin-top: -15px;
            margin-bottom: 0;
            border-radius: 0 0 8px 8px;
        }
        
        .waypoints-container::-webkit-scrollbar {
            width: 4px;
        }
        
        .waypoints-container::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 2px;
        }
        
        .waypoints-container::-webkit-scrollbar-thumb {
            background: var(--admin-red);
            border-radius: 2px;
        }
        
        .waypoints-container::-webkit-scrollbar-thumb:hover {
            background: #B91C1C;
        }
        
        .search-no-results {
            text-align: center;
            color: var(--text-secondary);
            padding: 2rem 1rem;
            font-style: italic;
        }
        
        .search-results-count {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            padding: 0 0.25rem;
        }
        
        .loading {
            text-align: center;
            color: var(--text-secondary);
            padding: 3rem 1rem;
            font-size: 1.1rem;
            position: relative;
        }
        
        .loading::after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--admin-red);
            animation: spin 1s ease-in-out infinite;
            margin-left: 0.5rem;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .map-controls {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1000;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            padding: 0.75rem;
            border: 1px solid var(--border-color);
        }
        
        .control-btn {
            display: block;
            width: 45px;
            height: 45px;
            margin-bottom: 0.5rem;
            border: none;
            background: var(--light-gray);
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            color: var(--text-primary);
            font-size: 1.1rem;
        }
        
        .control-btn:last-child {
            margin-bottom: 0;
        }
        
        .control-btn:hover {
            background: var(--admin-red);
            color: var(--white);
            transform: scale(1.05);
        }
        
        .control-btn.active {
            background: var(--admin-red);
            color: var(--white);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.3);
        }
        
        .add-mode-indicator {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background: var(--admin-red);
            color: var(--white);
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
            display: none;
            font-size: 0.875rem;
        }
        
        .add-mode-indicator.active {
            display: block;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        @keyframes slideInFromLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .mobile-nav-toggle {
                display: block;
            }
            
            .mobile-menu-overlay,
            .mobile-menu {
                display: block;
            }
            
            .contact-info {
                display: none;
            }
            
            .auth-buttons {
                display: none;
            }
            
            .user-menu {
                display: none;
            }
            
            .user-menu:has(.admin-logout-btn) {
                display: flex !important;
            }
            
            .logout-button {
                display: none;
            }

            .container {
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }
            
            .sidebar {
                width: 100%;
                order: 2;
            }
            
            .map-container {
                height: 400px;
                order: 1;
            }
            
            .admin-nav-container {
                padding: 0 1rem;
            }
            
            .admin-header h1 {
                font-size: 2rem;
            }
            
            .admin-header-content {
                padding: 0 1rem;
            }
            
            .waypoints-container {
                max-height: 150px;
            }
            
            .waypoint-item {
                padding: 0.4rem;
                margin-bottom: 0.25rem;
            }
            
            .waypoint-name {
                font-size: 0.8rem;
            }
            
            .waypoint-coords {
                font-size: 0.65rem;
            }
            
            .waypoint-description {
                font-size: 0.7rem;
                line-height: 1.2;
            }
        }

        @media (max-width: 1024px) {
            .user-menu {
                display: none;
            }
            
            .user-menu:has(.admin-logout-btn) {
                display: flex !important;
            }
        }
        
        @media (max-width: 480px) {
            .top-bar-container {
                padding: 0 1rem;
                font-size: 0.75rem;
                justify-content: flex-end;
                min-height: 36px;
            }
            
            .language-selector {
                gap: 0.5rem;
                margin-left: auto;
            }
            
            .language-selector a {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
                min-width: 32px;
                text-align: center;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .top-bar-container {
                padding: 0 1.5rem;
                justify-content: flex-end;
            }
            
            .language-selector {
                gap: 0.75rem;
                margin-left: auto;
            }
            
            .language-selector a {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                min-width: 32px;
                text-align: center;
            }
        }

        @media (max-width: 1024px) {
            .user-menu {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .user-menu {
                display: none;
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
                <a href="{{ route('profile') }}" class="nav-link">Profilul Meu</a>
                @endauth
                <a href="#" class="nav-link">Portofoliul Meu</a>
                <a href="#" class="nav-link">Analize</a>
                <a href="#" class="nav-link">Contact</a>
                @auth('admin')
                <a href="/admin" class="nav-link active" style="color: var(--accent-yellow); font-weight: 600;">🔐 Admin</a>
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
            <a href="{{ route('profile') }}" class="mobile-nav-link">Profilul Meu</a>
            @endauth
            <a href="#" class="mobile-nav-link">Portofoliul Meu</a>
            <a href="#" class="mobile-nav-link">Analize</a>
            <a href="#" class="mobile-nav-link">Contact</a>
            @auth('admin')
            <a href="/admin" class="mobile-nav-link active" style="color: var(--primary-green);">🔐 Admin</a>
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

    <div class="admin-header">
        <div class="admin-header-content">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                <div>
                    <h1>🔒 Manager de puncte</h1>
                </div>
                @auth('admin')
                <form action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="admin-logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Deconectare Admin
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="sidebar">
            <div class="section">
                <h2><i class="fas fa-plus-circle"></i> Adaugă Punct Nou</h2>
                <div class="instructions">
                    Activează "Modul Adăugare" folosind butonul + de pe hartă, apoi fă clic oriunde pe hartă pentru a plasa un punct. Doar tu poți adăuga puncte aici.
                </div>
                
                <form id="waypointForm" style="display: none;">
                    <div class="form-group">
                        <label for="waypointName">Numele Proiectului de Investiție</label>
                        <input type="text" id="waypointName" class="form-control" placeholder="ex., Parc Solar Chișinău" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="waypointDescription">Descrierea Proiectului</label>
                        <textarea id="waypointDescription" class="form-control" rows="3" placeholder="ex., Parc fotovoltaic de 50MW cu ROI anual de 15%"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Coordonate</label>
                        <div id="coordinatesDisplay" class="coordinates-display">
                            Fă clic pe hartă pentru a seta coordonatele
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i>
                        Salvează Locația de Investiție
                    </button>
                    <button type="button" id="cancelWaypoint" class="btn btn-danger btn-block" style="margin-top: 0.5rem;">
                        <i class="fas fa-times"></i>
                        Anulează
                    </button>
                </form>
            </div>
            
            <div class="section">
                <h2>📋 Toate Punctele (<span class="waypoints-count">0</span>)</h2>
                
                <div class="search-container">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="waypointSearch" placeholder="Caută locații..." class="search-input">
                        <button type="button" id="clearSearch" class="clear-search" title="Șterge căutarea">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="waypoints-container">
                    <div id="waypointsList" class="loading">
                        Se încarcă punctele...
                    </div>
                </div>
            </div>
        </div>
        
        <div class="map-container">
            <div class="add-mode-indicator" id="addModeIndicator">
                📍 Mod Admin Adăugare Activ - Fă clic pe hartă pentru a plasa punctul
            </div>
            <div class="map-controls">
                <button id="toggleAddMode" class="control-btn" title="Comută Modul Adăugare">+</button>
                <button id="clearAll" class="control-btn" title="Șterge Toate Punctele">🗑️</button>
                <button id="centerMap" class="control-btn" title="Centrează Harta">🎯</button>
            </div>
            <div id="map"></div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                control.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
            
            initializeSearch();
        });
        
        function initializeSearch() {
            const searchInput = document.getElementById('waypointSearch');
            const clearSearchBtn = document.getElementById('clearSearch');
            const searchBox = document.querySelector('.search-box');
            
            if (!searchInput || !clearSearchBtn || !searchBox) {
                console.log('Search elements not found, retrying...');
                setTimeout(initializeSearch, 100);
                return;
            }
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.trim();
                
                if (searchTerm) {
                    searchBox.classList.add('has-content');
                } else {
                    searchBox.classList.remove('has-content');
                }
                
                searchWaypoints(searchTerm);
            });
            
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                searchBox.classList.remove('has-content');
                searchWaypoints('');
                searchInput.focus();
            });
            
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    searchBox.classList.remove('has-content');
                    searchWaypoints('');
                    this.blur();
                }
            });
        }
        
        function searchWaypoints(searchTerm) {
            if (!searchTerm) {
                displayWaypoints();
                return;
            }
            
            const filtered = waypoints.filter(waypoint => {
                const searchLower = searchTerm.toLowerCase();
                return (
                    waypoint.name.toLowerCase().includes(searchLower) ||
                    (waypoint.description && waypoint.description.toLowerCase().includes(searchLower)) ||
                    waypoint.latitude.toString().includes(searchLower) ||
                    waypoint.longitude.toString().includes(searchLower)
                );
            });
            
            displayWaypoints(filtered);
        }
    </script>
    
    <script>
        let map;
        let waypoints = [];
        let markers = {};
        let addMode = false;
        let tempMarker = null;
        let tempLat = null;
        let tempLng = null;

        function initMap() {
            console.log('Initializing Leaflet map...');
            
            try {
                map = L.map('map').setView([47.0105, 28.8638], 8); 
                console.log('Map created successfully');

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                console.log('Tile layer added successfully');

                map.on('click', function(e) {
                    console.log('Map clicked:', e.latlng);
                    if (addMode) {
                        console.log('Add mode is active, setting temp waypoint');
                        setTempWaypoint(e.latlng.lat, e.latlng.lng);
                    }
                });
                console.log('Map click event listener added');
                
                console.log('Map initialization completed successfully');
            } catch (error) {
                console.error('Error initializing map:', error);
            }
        }

        function setTempWaypoint(lat, lng) {
            if (tempMarker) {
                map.removeLayer(tempMarker);
            }

            tempMarker = L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                })
            }).addTo(map);

            tempLat = lat;
            tempLng = lng;

            document.getElementById('coordinatesDisplay').textContent = 
                `Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}`;
            document.getElementById('coordinatesDisplay').classList.add('active');

            document.getElementById('waypointForm').style.display = 'block';
            document.getElementById('waypointName').focus();
        }

        function cancelWaypoint() {
            if (tempMarker) {
                map.removeLayer(tempMarker);
                tempMarker = null;
            }
            tempLat = null;
            tempLng = null;
            document.getElementById('waypointForm').style.display = 'none';
            document.getElementById('waypointForm').reset();
            document.getElementById('coordinatesDisplay').textContent = 'Fă clic pe hartă pentru a seta coordonatele';
            document.getElementById('coordinatesDisplay').classList.remove('active');
            setAddMode(false);
        }

        async function saveWaypoint(event) {
            event.preventDefault();

            if (!tempLat || !tempLng) {
                showNotification('Te rog să faci clic pe hartă pentru a seta coordonatele mai întâi', 'error');
                return;
            }

            const name = document.getElementById('waypointName').value;
            const description = document.getElementById('waypointDescription').value;

            try {
                console.log('Saving waypoint:', { name, description, latitude: tempLat, longitude: tempLng });
                const response = await fetch('/api/waypoints', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: name,
                        description: description,
                        latitude: tempLat,
                        longitude: tempLng
                    })
                });

                console.log('Save response status:', response.status);
                const data = await response.json();
                console.log('Save response data:', data);

                if (data.success) {
                    if (tempMarker) {
                        map.removeLayer(tempMarker);
                        tempMarker = null;
                    }

                    waypoints.push(data.waypoint);
                    createMarker(data.waypoint);

                    cancelWaypoint();
                    
                    displayWaypoints();
                    
                    showNotification(`Locația de investiție "${name}" salvată cu succes!`, 'success');
                } else {
                    showNotification('Eroare la salvarea punctului', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Eroare la salvarea punctului', 'error');
            }
        }
        
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--primary-green)' : type === 'error' ? '#EF4444' : 'var(--admin-red)'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 10px;
                box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
                z-index: 10000;
                transform: translateX(100%);
                transition: all 0.3s ease;
                max-width: 300px;
                font-weight: 500;
            `;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        function createMarker(waypoint) {
            try {
                const lat = parseFloat(waypoint.latitude);
                const lng = parseFloat(waypoint.longitude);
                
                const marker = L.marker([lat, lng], {
                    icon: L.icon({
                        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                        shadowSize: [41, 41]
                    })
                }).addTo(map);

                const popupContent = `
                    <div style="max-width: 250px;">
                        <h3 style="margin: 0 0 0.5rem 0; color: #0e411f; font-weight: 700;">🌱 ${waypoint.name}</h3>
                        ${waypoint.description ? `<p style="margin: 0 0 0.5rem 0; color: #4a5568; line-height: 1.4;">${waypoint.description}</p>` : ''}
                        <p style="margin: 0; font-size: 0.8rem; color: #718096; font-family: monospace;">
                            📍 ${lat.toFixed(6)}, ${lng.toFixed(6)}
                        </p>
                    </div>
                `;

                marker.bindPopup(popupContent);
                markers[waypoint.id] = marker;
            } catch (error) {
                console.error('Error creating marker:', error);
                throw error;
            }
        }

        async function loadWaypoints() {
            try {
                const response = await fetch('/api/waypoints');
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                waypoints = data;
                
                Object.values(markers).forEach(marker => {
                    map.removeLayer(marker);
                });
                markers = {};

                waypoints.forEach((waypoint) => {
                    try {
                        createMarker(waypoint);
                    } catch (error) {
                        console.error(`Error creating marker for waypoint ${waypoint.id}:`, error);
                    }
                });

                displayWaypoints();
                
                const waypointsListElement = document.getElementById('waypointsList');
                if (waypointsListElement) {
                    waypointsListElement.style.opacity = '1';
                }
            } catch (error) {
                console.error('Eroare la încărcarea punctelor:', error);
                
                const waypointsListElement = document.getElementById('waypointsList');
                if (waypointsListElement) {
                    waypointsListElement.innerHTML = 
                        `<div style="color: #e53e3e; text-align: center; padding: 1rem;">
                            <strong>Eroare la încărcarea punctelor:</strong><br>
                            ${error.message}<br>
                            <button class="btn btn-admin btn-sm" onclick="loadWaypoints()" style="margin-top: 0.5rem;">Încearcă din nou</button>
                        </div>`;
                }
            }
        }
        
        function displayWaypoints(filteredWaypoints = null) {
            const container = document.getElementById('waypointsList');
            console.log('Container element:', container);
            
            if (!container) {
                console.error('waypointsList container not found!');
                return;
            }
            
            const waypointsToShow = filteredWaypoints || waypoints;
            
            const countElement = document.querySelector('.waypoints-count');
            if (countElement) {
                countElement.textContent = waypoints.length;
                console.log('Updated waypoint count to:', waypoints.length);
            } else {
                console.log('waypoints-count element not found');
            }
            
            if (waypointsToShow.length === 0) {
                const isFiltered = filteredWaypoints !== null;
                container.innerHTML = `
                    <div class="${isFiltered ? 'search-no-results' : ''}" style="text-align: center; color: #718096; padding: 2rem;">
                        <div style="font-size: ${isFiltered ? '2rem' : '3rem'}; margin-bottom: 1rem;">${isFiltered ? '🔍' : '🌱'}</div>
                        <div style="font-weight: 600; margin-bottom: 0.5rem;">
                            ${isFiltered ? 'Nu s-au găsit locații potrivite!' : 'Nu există încă locații de investiții!'}
                        </div>
                        <div style="font-size: 0.9rem;">
                            ${isFiltered ? 'Încearcă un alt termen de căutare.' : 'Fă clic pe butonul + de pe hartă pentru a adăuga prima ta oportunitate de investiție.'}
                        </div>
                    </div>
                `;
                return;
            }

            let resultsCountHtml = '';
            if (filteredWaypoints !== null && filteredWaypoints.length !== waypoints.length) {
                resultsCountHtml = `<div class="search-results-count">Se afișează ${filteredWaypoints.length} din ${waypoints.length} locații</div>`;
            }

            container.innerHTML = resultsCountHtml + waypointsToShow.map(waypoint => `
                <div class="waypoint-item">
                    <div class="waypoint-name">
                        🌱 ${waypoint.name}
                    </div>
                    <div class="waypoint-coords">
                        📍 ${parseFloat(waypoint.latitude).toFixed(6)}, ${parseFloat(waypoint.longitude).toFixed(6)}
                    </div>
                    ${waypoint.description ? `<div class="waypoint-description">${waypoint.description}</div>` : ''}
                    <div class="waypoint-actions">
                        <button class="btn btn-success btn-sm" onclick="centerOnWaypoint(${waypoint.id})" title="Vezi această locație de investiție">
                            🎯 Vezi Locația
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteWaypoint(${waypoint.id})" title="Șterge această locație de investiție">
                            🗑️ Șterge
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function centerOnWaypoint(id) {
            const waypoint = waypoints.find(w => w.id === id);
            if (waypoint) {
                map.setView([parseFloat(waypoint.latitude), parseFloat(waypoint.longitude)], 15);
                if (markers[id]) {
                    markers[id].openPopup();
                }
            }
        }

        async function deleteWaypoint(id) {
            if (!confirm('Ești sigur că vrei să ștergi această locație de investiție? Aceasta va fi eliminată de pe harta publică.')) {
                return;
            }

            try {
                const response = await fetch(`/api/waypoints/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    if (markers[id]) {
                        map.removeLayer(markers[id]);
                        delete markers[id];
                    }

                    waypoints = waypoints.filter(w => w.id !== id);

                    displayWaypoints();
                    
                    showNotification('Locația de investiție ștearsă cu succes', 'success');
                } else {
                    showNotification('Eroare la ștergerea punctului', 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Eroare la ștergerea punctului', 'error');
            }
        }

        function setAddMode(enabled) {
            addMode = enabled;
            const btn = document.getElementById('toggleAddMode');
            const indicator = document.getElementById('addModeIndicator');
            
            if (enabled) {
                btn.classList.add('active');
                btn.innerHTML = '✓';
                indicator.classList.add('active');
                map.getContainer().style.cursor = 'crosshair';
            } else {
                btn.classList.remove('active');
                btn.innerHTML = '+';
                indicator.classList.remove('active');
                map.getContainer().style.cursor = '';
            }
        }

        async function clearAllWaypoints() {
            if (!confirm('Ești sigur că vrei să ștergi TOATE locațiile de investiții? Această acțiune nu poate fi anulată și le va elimina de pe harta publică.')) {
                return;
            }

            try {
                const deletePromises = waypoints.map(waypoint => 
                    fetch(`/api/waypoints/${waypoint.id}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                );

                await Promise.all(deletePromises);

                Object.values(markers).forEach(marker => {
                    map.removeLayer(marker);
                });
                markers = {};

                waypoints = [];

                displayWaypoints();
                
                showNotification('Toate locațiile de investiții au fost șterse cu succes', 'success');
            } catch (error) {
                console.error('Error:', error);
                showNotification('Eroare la ștergerea punctelor', 'error');
            }
        }

        function centerMap() {
            map.setView([47.0105, 28.8638], 8);
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded - Starting initialization...');
            
            try {
                console.log('Initializing map...');
                initMap();
                console.log('Map initialized successfully');
                
                console.log('Loading waypoints...');
                loadWaypoints();
            } catch (error) {
                console.error('Error during initialization:', error.message);
            }

            document.getElementById('waypointForm').addEventListener('submit', saveWaypoint);

            document.getElementById('cancelWaypoint').addEventListener('click', cancelWaypoint);

            document.getElementById('toggleAddMode').addEventListener('click', function() {
                setAddMode(!addMode);
            });

            document.getElementById('clearAll').addEventListener('click', clearAllWaypoints);
            document.getElementById('centerMap').addEventListener('click', centerMap);
            
            console.log('All event listeners attached successfully');
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
