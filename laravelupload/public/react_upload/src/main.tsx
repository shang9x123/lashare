import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App'
import './index.css'
import {RecoilRoot} from "recoil";
import {BrowserRouter,Routes,Route} from "react-router-dom";
import Post from "./pages/Post";

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
      <RecoilRoot>
            <BrowserRouter>
                <Routes>
                    <Route element={<App />} path='/'></Route>
                    <Route element={<Post />} path='/post'></Route>
                </Routes>
            </BrowserRouter>
      </RecoilRoot>
  </React.StrictMode>,
)
