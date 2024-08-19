import React, { StrictMode } from 'react';
//import ReactDOM from 'react-dom';
import { createRoot } from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { HelmetProvider } from 'react-helmet-async';
import { ForceProvider } from './contexts/Force'
import Scroller from './components/Scroller'
import Transitor from './components/Transitor'
import Header from './components/Header'
import Footer from './components/Footer'
import HomePage from './pages/HomePage';
import GetMySitePage from './pages/GetMySitePage';
import NotFoundPage from './pages/NotFoundPage';


window.SYSTEM = {
    ajaxurl: '/admin/wp-admin/admin-ajax.php',
    restBasePath: '/admin/wp-json/'
};

window.gscroll = null;

const mainNode = document.getElementById('viewport');
const root = createRoot(mainNode);


const App = () => {
    
    return (
        <Router>
            <ForceProvider>
                <Header />
                <Scroller>
                    <Transitor>
                        
                        <Routes>
                            <Route path="/" exact element={<HomePage />} />
                            <Route path="/obtenir-mon-site" element={<GetMySitePage />} />
                            <Route path="*" element={<NotFoundPage />} />
                        </Routes>
                        
                        <Footer />
                        
                    </Transitor>
                </Scroller>
            </ForceProvider>
        </Router>
    );
    
};

root.render(
    //<StrictMode>
        <HelmetProvider>
            <App />
        </HelmetProvider>
    //</StrictMode>
);