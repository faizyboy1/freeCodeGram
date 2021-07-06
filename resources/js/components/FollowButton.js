import axios from 'axios';
import React from 'react';
import ReactDOM from 'react-dom';

const followUser=()=>{
    return axios.post('/follow/1').then($response =>{
        alert($response.data);
    })
}
function FollowButton() {
    
    return (
        
            <button class="btn btn-primary ml-4" onClick={followUser}>Follow</button>
       
    );
}

export default FollowButton;

if (document.getElementById('followButton')) {
    ReactDOM.render(<FollowButton />, document.getElementById('followButton'));
}
