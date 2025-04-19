import React, {useEffect,useState} from 'react';
import API from '../api/api';
export default function Dashboard(){
  const [info,setInfo]=useState({});
  useEffect(()=>{/* fetch profile & api_key */},[]);
  const genKey=async ()=>{ await axios.post('/api/api-key/generate'); window.location.reload(); };
  return (<div>/* show info, button to gen */</div>);
}