<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Interactive Waypoint Map - QGroup Investment</title>
    
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

        .auth-btn.active {
            background: var(--primary-green);
            color: var(--white);
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

        
        .cta-button {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(148, 186, 42, 0.4);
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(135deg, rgba(255,215,0,0.1) 0%, rgba(148,186,42,0.1) 100%);
            clip-path: polygon(0 60%, 100% 40%, 100% 100%, 0% 100%);
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .header h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .header p {
            font-size: 1.25rem;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
            font-weight: 300;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            display: flex;
            gap: 2rem;
            min-height: calc(100vh - 300px);
        }
        
        .sidebar {
            width: 380px;
            min-width: 380px;
            max-width: 380px;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            height: fit-content;
            max-height: calc(100vh - 200px);
            border: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
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
            border-radius: 12px;
        }
        
        .section {
            margin-bottom: 1rem;
        }
        
        .section:last-child {
            margin-bottom: 0;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }
        
        .section h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1.25rem;
            padding: 1.25rem 0 0.875rem 0;
            border-bottom: 3px solid var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-green-light) 0%, rgba(148, 186, 42, 0.08) 100%);
            border-radius: 15px 15px 0 0;
            position: relative;
            box-shadow: 0 3px 12px rgba(148, 186, 42, 0.15);
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.02em;
        }
        
        .section h2::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--accent-yellow) 50%, var(--primary-green) 100%);
            border-radius: 0 0 4px 4px;
        }
        
        .section h2 i {
            color: var(--primary-green);
            font-size: 1.2rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .section h2 .waypoints-count {
            color: var(--text-secondary);
            font-size: 0.9rem;
            font-weight: 400;
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
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(148, 186, 42, 0.1);
            transform: translateY(-1px);
        }
        
        .form-control:valid {
            border-color: var(--primary-green);
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
            color: var(--primary-green);
        }
        
        .btn {
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 8px;
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
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(148, 186, 42, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
            border: 2px solid transparent;
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
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }
        
        .btn-block {
            width: 100%;
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
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            border-radius: 4px 0 0 4px;
        }
        
        .waypoint-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
            border-color: var(--primary-green);
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
            background: rgba(148, 186, 42, 0.08);
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
        
        #waypointsList {
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
        
        #waypointsList::after {
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
        
        #waypointsList::-webkit-scrollbar {
            width: 4px;
        }
        
        #waypointsList::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 2px;
        }
        
        #waypointsList::-webkit-scrollbar-thumb {
            background: var(--primary-green);
            border-radius: 2px;
        }
        
        #waypointsList::-webkit-scrollbar-thumb:hover {
            background: var(--primary-green-dark);
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .coordinates-display {
            background: var(--light-gray);
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            font-family: 'Monaco', 'Menlo', monospace;
            font-size: 0.875rem;
            color: var(--text-secondary);
            text-align: center;
            transition: all 0.3s;
        }
        
        .coordinates-display.active {
            border-color: var(--primary-green);
            background: rgba(148, 186, 42, 0.05);
            color: var(--primary-green);
        }
        
        .instructions {
            background: linear-gradient(135deg, rgba(148, 186, 42, 0.1) 0%, rgba(148, 186, 42, 0.05) 100%);
            border: 1px solid rgba(148, 186, 42, 0.2);
            border-radius: 12px;
            padding: 1rem;
            color: var(--primary-green-dark);
            font-size: 0.85rem;
            line-height: 1.5;
            position: relative;
        }
        
        .instructions::before {
            content: '💡';
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 1.25rem;
        }
        
        .instructions {
            padding-left: 2.5rem;
        }
        

        
        .search-container {
            margin-bottom: 1rem;
        }
        
        .search-box {
            position: relative;
            background: linear-gradient(135deg, var(--white) 0%, rgba(148, 186, 42, 0.03) 100%);
            border: 2px solid var(--border-color);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
            transform: translateZ(0);
            backface-visibility: hidden; 
        }
        
        .search-box:focus-within {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(148, 186, 42, 0.15), 0 6px 20px rgba(148, 186, 42, 0.12);
            transform: translateY(-2px);
            background: linear-gradient(135deg, var(--white) 0%, rgba(148, 186, 42, 0.05) 100%);
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 3rem 1rem 1.25rem;
            border: none;
            outline: none;
            font-size: 0.95rem;
            background: transparent;
            color: var(--text-primary);
            font-weight: 500;
            box-shadow: none;
        }
        
        .search-input::placeholder {
            color: var(--text-secondary);
            font-weight: 400;
        }
        
        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            transition: all 0.3s;
            font-size: 1.1rem;
            z-index: 5;
        }
        
        .search-box:focus-within .search-icon {
            color: var(--primary-green);
            transform: translateY(-50%) scale(1.1);
        }
        
        .clear-search {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: var(--primary-green);
            border: none;
            color: var(--white);
            cursor: pointer;
            font-size: 0.8rem;
            opacity: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 10;
        }

        
        .clear-search:hover {
            color: var(--primary-green);
        }
        
        .search-box.has-content .clear-search {
            opacity: 1;
        }
        
        .search-box.has-content .search-icon {
            opacity: 0;
        }
        
        .search-no-results {
            text-align: center;
            color: var(--text-secondary);
            padding: 2rem 1rem;
            font-style: italic;
            font-size: 0.9rem;
        }
        
        .search-results-count {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
            padding: 0.5rem 0.75rem;
            background: rgba(148, 186, 42, 0.08);
            border-radius: 8px;
            text-align: center;
            border-left: 3px solid var(--primary-green);
            animation: slideInFromTop 0.3s ease-out;
        }
        
        
        .waypoint-item:nth-child(2) { animation-delay: 0.05s; }
        .waypoint-item:nth-child(3) { animation-delay: 0.1s; }
        .waypoint-item:nth-child(4) { animation-delay: 0.15s; }
        .waypoint-item:nth-child(5) { animation-delay: 0.2s; }
        
        .search-no-results {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInFromTop {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInFromLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .map-controls {
            position: absolute;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            display: flex;
            gap: 0.5rem;
        }
        
        .control-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin: 0;
            border: 2px solid var(--border-color);
            background: linear-gradient(135deg, var(--white) 0%, var(--light-gray) 100%);
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            color: var(--text-primary);
            font-size: 1.2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .control-btn:last-child {
            margin-bottom: 0;
        }
        
        .control-btn:hover {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
            border-color: var(--primary-green);
        }
        
        .control-btn.active {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%);
            color: var(--white);
            box-shadow: 0 0 0 3px rgba(148, 186, 42, 0.3);
            border-color: var(--primary-green);
            transform: translateY(-1px);
        }
        
        .add-mode-indicator {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background: var(--primary-green);
            color: var(--white);
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(148, 186, 42, 0.3);
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
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .investment-card {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        
        .investment-card:nth-child(1) { animation-delay: 0.1s; }
        .investment-card:nth-child(2) { animation-delay: 0.2s; }
        .investment-card:nth-child(3) { animation-delay: 0.3s; }
        
        .sidebar {
            animation: slideInLeft 0.6s ease-out;
        }
        
        .map-container {
            animation: fadeInUp 0.6s ease-out 0.2s both;
        }
        
        .investment-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .investment-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-color);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .investment-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-green) 0%, var(--accent-yellow) 100%);
        }
        
        .investment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 35px rgba(0, 0, 0, 0.12);
        }
        
        .investment-card h3 {
            color: var(--primary-green-dark);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .investment-card .benefit-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: var(--primary-green-light);
            border-radius: 10px;
        }
        
        .investment-card .benefit-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-green);
            color: var(--white);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        
        .investment-card .benefit-text {
            font-weight: 500;
            color: var(--text-primary);
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
                
        @media (max-width: 480px) {
            .top-bar-container {
                padding: 0 1rem;
                font-size: 0.75rem;
                justify-content: flex-end;
                min-height: 36px;
            }
            
            .contact-info {
                gap: 1rem;
            }
            
            .contact-info a {
                font-size: 0.75rem;
            }
            
            .language-selector {
                gap: 0.5rem;
                margin-left: auto;
            }
            
            .language-selector a {
                padding: 0.2rem 0.4rem;
                font-size: 0.75rem;
                min-width: 28px;
                text-align: center;
                display: inline-block;
            }
            
            .top-nav-content {
                padding: 0.75rem 1rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                font-size: 1.25rem;
            }
            
            .logo::before {
                font-size: 1.5rem;
            }
            
            .auth-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.875rem;
            }
            
            .nav-links {
                gap: 1rem;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .nav-link {
                padding: 0.75rem 0;
                font-size: 0.875rem;
            }
            
            .header {
                padding: 2rem 1rem;
            }
            
            .header h1 {
                font-size: 1.75rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            .container {
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }
            
            .sidebar {
                width: 100%;
                min-width: unset;
                max-width: unset;
                order: 2;
                padding: 1rem;
            }
            
            #waypointsList {
                max-height: 150px;
            }
            
            .map-container {
                height: 300px;
                order: 1;
            }
            
            .investment-cards {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .investment-card {
                padding: 1.25rem;
            }
            
            .investment-card h3 {
                font-size: 1.125rem;
            }
            
            .benefit-item {
                padding: 0.5rem;
                gap: 0.5rem;
            }
            
            .benefit-icon {
                width: 32px;
                height: 32px;
                font-size: 0.75rem;
            }
            
            .map-controls {
                top: 10px;
                left: 50%;
                transform: translateX(-50%);
                padding: 0.5rem;
            }
            
            .control-btn {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1.5rem;
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
            
            .top-nav-content,
            .main-nav-content {
                padding: 0 1.5rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .nav-links {
                gap: 1.5rem;
                overflow-x: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            
            .nav-links::-webkit-scrollbar {
                display: none;
            }
            
            .container {
                flex-direction: column;
                padding: 1.5rem;
                gap: 1.5rem;
            }
            
            .sidebar {
                width: 100%;
                min-width: unset;
                max-width: unset;
                order: 2;
                padding: 1.5rem;
            }
            
            .map-container {
                height: 400px;
                order: 1;
            }
            
            .investment-cards {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
            }
            
            .header h1 {
                font-size: 2.25rem;
            }
        }
        
        @media (min-width: 769px) and (max-width: 1024px) {
            .top-bar-container {
                padding: 0 1.5rem;
                justify-content: flex-end;
            }
            
            .language-selector {
                gap: 1rem;
                margin-left: auto;
            }
            
            .language-selector a {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
            
            .container {
                max-width: 100%;
                padding: 2rem 1.5rem;
            }
            
            .sidebar {
                width: 320px;
                min-width: 320px;
                max-width: 320px;
            }
            
            .investment-cards {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
            
            .nav-links {
                gap: 1.5rem;
            }
        }
        
        @media (min-width: 1025px) and (max-width: 1200px) {
            .container {
                max-width: 1000px;
                padding: 2rem;
            }
            
            .sidebar {
                width: 350px;
                min-width: 350px;
                max-width: 350px;
            }
        }
        
        @media (min-width: 1201px) {
            .container {
                max-width: 1200px;
            }
            
            .header h1 {
                font-size: 3.5rem;
            }
            
            .header p {
                font-size: 1.375rem;
            }
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
            
            .logout-button {
                display: none;
            }
            
            .language-selector {
                order: 1;
                margin-left: auto;
                margin-right: 0;
            }
            
            .top-bar-container {
                justify-content: flex-end;
            }
        }

        @media (max-width: 1024px) {
            .user-menu {
                display: none;
            }
        }
        
        @media (hover: none) and (pointer: coarse) {
            .nav-link,
            .auth-btn,
            .control-btn,
            .btn {
                min-height: 44px;
                min-width: 44px;
            }
            
            .mobile-nav-link {
                padding: 1.25rem 0;
            }
            
            .mobile-auth-btn {
                padding: 1.25rem;
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
                <a href="{{ route('map') }}" class="nav-link active">Hartă Investiții</a>
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
            <a href="{{ route('map') }}" class="mobile-nav-link active">Hartă Investiții</a>
            @auth('web')
            <a href="{{ route('profile') }}" class="mobile-nav-link">Profilul Meu</a>
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

    <div class="header">
        <div class="header-content">
            <h1>🗺️ Hartă Interactivă de Investiții</h1>
            <p>Gestionați punctele de interes pentru proiectele dumneavoastră de energie verde cu harta noastră interactivă</p>
        </div>
    </div>

    <section style="background: var(--white); padding: 4rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="text-align: center; margin-bottom: 3rem;">
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--primary-green-dark); margin-bottom: 1rem;">
                    🌱 Investiții în Energie Verde
                </h2>
                <p style="font-size: 1.125rem; color: var(--text-secondary); max-width: 600px; margin: 0 auto;">
                    Descoperiți oportunitățile de investiții profitabile în parcuri fotovoltaice cu harta noastră interactivă
                </p>
            </div>
            
            <div class="investment-cards">
                <div class="investment-card">
                    <h3>💰 ROI Garantat</h3>
                    <div class="benefit-item">
                        <div class="benefit-icon">15%</div>
                        <div class="benefit-text">Randament anual garantat</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">20</div>
                        <div class="benefit-text">Ani contract cu statul</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">€</div>
                        <div class="benefit-text">Plăți în Euro</div>
                    </div>
                </div>
                
                <div class="investment-card">
                    <h3>🏗️ Servicii Complete</h3>
                    <div class="benefit-item">
                        <div class="benefit-icon">📋</div>
                        <div class="benefit-text">Documentație completă</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">🔧</div>
                        <div class="benefit-text">Construcție & mentenanță</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">📊</div>
                        <div class="benefit-text">Monitorizare 24/7</div>
                    </div>
                </div>
                
                <div class="investment-card">
                    <h3>🌍 Impact Pozitiv</h3>
                    <div class="benefit-item">
                        <div class="benefit-icon">🌱</div>
                        <div class="benefit-text">Energie curată</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">💚</div>
                        <div class="benefit-text">Zero emisii CO2</div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">🏡</div>
                        <div class="benefit-text">Dezvoltare durabilă</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-dark) 100%); padding: 4rem 0; margin: 2rem 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; text-align: center;">
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--white); margin-bottom: 1rem;">
                🚀 Începeți Investiția Dumneavoastră Astăzi
            </h2>
            <p style="font-size: 1.125rem; color: rgba(255,255,255,0.9); max-width: 600px; margin: 0 auto 2rem;">
                Folosiți harta interactivă pentru a identifica locațiile perfecte pentru proiectele dumneavoastră de energie verde și începeți să câștigați din investiții durabile.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="#" class="cta-button" style="background: var(--white); color: var(--primary-green); font-weight: 700;">
                    <i class="fas fa-calculator"></i>
                    Calculează ROI
                </a>
                <a href="#" class="cta-button" style="background: rgba(255,255,255,0.1); border: 2px solid var(--white); backdrop-filter: blur(10px);">
                    <i class="fas fa-download"></i>
                    Descarcă Broșura
                </a>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="sidebar">
            <div class="section">
                <h2>🌱 Locații de Investiții</h2>
                <div class="instructions">
                    Explorați oportunitățile noastre de investiții în Moldova. Fiecare locație reprezintă un proiect atent selecționat cu potențial ROI puternic.
                    <br><br>
                    <strong>🎯 Interesați să investiți?</strong><br>
                    Contactați echipa noastră la <a href="mailto:investor@qgroup.md" style="color: var(--primary-green); font-weight: 600;">investor@qgroup.md</a> sau sunați la <a href="tel:+37378940400" style="color: var(--primary-green); font-weight: 600;">+373 78 940 400</a> pentru informații detaliate despre orice oportunitate de investiție.
                </div>
                

            </div>
            
            <div class="section">
                <h2>📋 Locații Disponibile (<span class="waypoints-count">0</span>)</h2>
                
                <div class="search-container">
                    <div class="search-box">
                        <input type="text" id="waypointSearch" placeholder="Caută locații..." class="search-input">
                        <i class="fas fa-search search-icon"></i>
                        <button type="button" class="clear-search" title="Clear search">×</button>
                    </div>
                </div>
                
                <div id="waypointsList">
                </div>
            </div>
        </div>
        
        <div class="map-container">
            <div class="map-controls">
                <button id="centerMap" class="control-btn" title="Center Map">🎯</button>
            </div>
            <div id="map"></div>
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
            
            const ctaButtons = document.querySelectorAll('a[href="#"]');
            ctaButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('CTA clicked:', this.textContent.trim());
                });
            });
        });
    </script>
    
    <script>
        let map;
        let waypoints = [];
        let markers = {};

        function initMap() {
            console.log('Initializing Leaflet map...');
            
            try {
                map = L.map('map').setView([47.0105, 28.8638], 8); 
                console.log('Map created successfully');

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                console.log('Tile layer added successfully');

                console.log('Map clicked:', e.latlng);
                console.log('Map click event listener added');

                if (navigator.geolocation) {
                    console.log('Geolocation is available, getting user location...');
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        console.log('User location:', lat, lng);
                        map.setView([lat, lng], 13);
                    }, function(error) {
                        console.log('Geolocation error:', error);
                    });
                } else {
                    console.log('Geolocation is not available');
                }
                
                console.log('Map initialization completed successfully');
            } catch (error) {
                console.error('Error initializing map:', error);
            }
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
                        <h3 style="margin: 0 0 0.5rem 0; color: #2d3748;">${waypoint.name}</h3>
                        ${waypoint.description ? `<p style="margin: 0 0 0.5rem 0; color: #4a5568;">${waypoint.description}</p>` : ''}
                        <p style="margin: 0; font-size: 0.8rem; color: #718096;">
                            ${lat.toFixed(6)}, ${lng.toFixed(6)}
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
                
            } catch (error) {
                console.error('Eroare la încărcarea punctelor:', error);
                
                const waypointsListElement = document.getElementById('waypointsList');
                if (waypointsListElement) {
                    waypointsListElement.innerHTML = 
                        `<div style="color: #e53e3e; text-align: center; padding: 1rem;">
                            <strong>Eroare la încărcarea punctelor:</strong><br>
                            ${error.message}<br>
                            <button class="btn btn-primary btn-sm" onclick="loadWaypoints()" style="margin-top: 0.5rem;">Încearcă din nou</button>
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
            
            const waypointsToDisplay = filteredWaypoints || waypoints;
            const isFiltered = filteredWaypoints !== null;
            
            const countElement = document.querySelector('.waypoints-count');
            if (countElement) {
                countElement.textContent = waypointsToDisplay.length;
                console.log('Updated waypoint count to:', waypointsToDisplay.length);
            } else {
                console.log('waypoints-count element not found');
            }
            
            let searchResultsInfo = '';
            if (isFiltered) {
                searchResultsInfo = `<div class="search-results-count">Showing ${waypointsToDisplay.length} of ${waypoints.length} locations</div>`;
            }
            
            if (waypointsToDisplay.length === 0) {
                if (isFiltered) {
                    container.innerHTML = searchResultsInfo + `
                        <div class="search-no-results">
                            <div style="font-size: 2rem; margin-bottom: 0.75rem;">🔍</div>
                            <div style="font-weight: 600; margin-bottom: 0.5rem;">Nu s-au găsit locații potrivite</div>
                            <div style="font-size: 0.85rem;">Încercați să ajustați termenii de căutare sau răsfoiți toate locațiile disponibile.</div>
                        </div>
                    `;
                } else {
                    container.innerHTML = `
                        <div style="text-align: center; color: #718096; padding: 1.5rem;">
                            <div style="font-size: 2.5rem; margin-bottom: 0.75rem;">🌱</div>
                            <div style="font-weight: 600; margin-bottom: 0.5rem;">Nu există încă oportunități de investiție!</div>
                            <div style="font-size: 0.85rem;">Noi oportunități de investiție vor apărea aici când vor fi adăugate de echipa noastră.</div>
                        </div>
                    `;
                }
                return;
            }

            container.innerHTML = searchResultsInfo + waypointsToDisplay.map(waypoint => `
                <div class="waypoint-item">
                    <div class="waypoint-name">
                        🌱 ${waypoint.name}
                    </div>
                    <div class="waypoint-coords">
                        📍 ${parseFloat(waypoint.latitude).toFixed(6)}, ${parseFloat(waypoint.longitude).toFixed(6)}
                    </div>
                    ${waypoint.description ? `<div class="waypoint-description">${waypoint.description}</div>` : ''}
                    <div class="waypoint-actions">
                        <button class="btn btn-success btn-sm" onclick="centerOnWaypoint(${waypoint.id})" title="View this investment location">
                            🎯 Vezi Locația
                        </button>
                    </div>
                </div>
            `).join('');
            
            setTimeout(() => {
                const isScrollable = container.scrollHeight > container.clientHeight;
                if (isScrollable && waypoints.length > 3) {
                    const scrollIndicator = document.createElement('div');
                    scrollIndicator.className = 'scroll-indicator';
                    scrollIndicator.innerHTML = `
                        <small style="color: var(--text-secondary); font-size: 0.7rem; text-align: center; display: block; margin-top: 0.5rem; opacity: 0.7;">
                            <i class="fas fa-chevron-down"></i> Scroll to see all ${waypoints.length} locations
                        </small>
                    `;
                    container.parentElement.appendChild(scrollIndicator);
                    
                    container.addEventListener('scroll', function() {
                        if (container.scrollTop + container.clientHeight >= container.scrollHeight - 5) {
                            if (scrollIndicator.parentElement) {
                                scrollIndicator.remove();
                            }
                        }
                    });
                }
            }, 100);
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

        function centerMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    map.setView([lat, lng], 13);
                }, function(error) {
                    map.setView([47.0105, 28.8638], 8);
                });
            } else {
                map.setView([47.0105, 28.8638], 8);
            }
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

            document.getElementById('centerMap').addEventListener('click', centerMap);
            
            initializeSearch();
            
            function initializeSearch() {
                const searchInput = document.getElementById('waypointSearch');
                const clearSearchBtn = document.querySelector('.clear-search');
                const searchBox = document.querySelector('.search-box');
                
                if (!searchInput || !searchBox) {
                    console.log('Search elements not found');
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
                
                if (clearSearchBtn) {
                    clearSearchBtn.addEventListener('click', function() {
                        searchInput.value = '';
                        searchBox.classList.remove('has-content');
                        searchWaypoints('');
                    });
                }
                
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const searchTerm = this.value.trim();
                        searchWaypoints(searchTerm);
                    }
                });
            }
            
            console.log('Event listeners attached successfully');
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
