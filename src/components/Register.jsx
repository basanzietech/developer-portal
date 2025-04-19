import React, {useState} from 'react';
import axios from 'axios';
export default function Register() {
  const [form,setForm]=useState({username:'',email:'',password:''});
  const submit=async e=>{
    e.preventDefault();
    await axios.post('/register',form);
    window.location='/login';
  };
  return (<form onSubmit={submit}>/* inputs */</form>);
}