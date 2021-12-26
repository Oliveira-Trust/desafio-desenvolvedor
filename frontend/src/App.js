import { useEffect } from 'react';
import './App.css';
import Header from './components/Header';
import { getCurrencies } from './services/api';

function App() {
  getCurrencies().then((res)=>console.log(res))
  
  return (
    <div className="App">
      <Header/>
    </div>
  );
}

export default App;
