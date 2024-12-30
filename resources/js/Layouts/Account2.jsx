import React, { useState, useEffect } from 'react';
import { NavDropdown } from 'react-bootstrap';
import { usePage, router } from '@inertiajs/react';
import Sidebar2 from '../Components/Sidebar2';

export default function NewLayout({ children }) {
    const { auth } = usePage().props;
    const [sidebarToggle, setSidebarToggle] = useState(false);
    const [theme, setTheme] = useState(localStorage.getItem('theme') || 'light');

    const sidebarToggleHandler = (e) => {
        e.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled', !sidebarToggle);
        setSidebarToggle(!sidebarToggle);
    };

    const logoutHandler = (e) => {
        e.preventDefault();
        router.post('/logout');
    };

    const toggleTheme = () => {
        const newTheme = theme === 'light' ? 'dark' : 'light';
        setTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    };

    useEffect(() => {
        document.body.setAttribute('data-theme', theme);
    }, [theme]);

    return (
        <>
            <div className="d-flex sb-sidenav-toggled" id="wrapper">
                <div className="bg-sidebar" id="sidebar-wrapper" style={{backgroundColor: 'var(--sidebar-bg)', color: 'var(--text-color)'}}>
                    <Sidebar2 />
                </div>
                <div id="page-content-wrapper">
                    <nav className="navbar navbar-expand-lg" style={{backgroundColor: 'var(--nav-bg)'}}>
                        <div className="container-fluid">
                            <button className="btn btn-success-dark" onClick={sidebarToggleHandler}>
                                <i className="fa fa-list-ul"></i>
                            </button>
                            <div className="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul className="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <NavDropdown title={auth.user.name} className="fw-bold" id="basic-nav-dropdown">
                                        <NavDropdown.Item onClick={toggleTheme}>
                                            <i className="fa fa-adjust me-2"></i> Toggle Theme
                                        </NavDropdown.Item>
                                        <NavDropdown.Item onClick={logoutHandler}>
                                            <i className="fa fa-sign-out-alt me-2"></i> Logout
                                        </NavDropdown.Item>
                                    </NavDropdown>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div className="container-fluid">
                        {children}
                    </div>
                </div>
            </div>
        </>
    );
}
