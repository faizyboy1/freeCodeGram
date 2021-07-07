import axios from 'axios';
import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';

const followUser=(user_id)=>{
    return axios.post(`/follow/${user_id}`).then($response =>{
        alert($response.data);
    });
}
function FollowButton(props) {
    
    const {user_id}=props;
    console.log([user_id]);
    return (
        
            <button className="btn btn-primary ml-4" onClick={()=>followUser(user_id)}>Follow</button>
       
    );
}

export default FollowButton;

if (document.getElementById('followButton')) {
    let user_id=document.getElementById('followButton').getAttribute('user_id');
    ReactDOM.render(<FollowButton user_id={user_id} />, document.getElementById('followButton'));
}
