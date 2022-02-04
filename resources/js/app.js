/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//require('./components/timer');
import Timer from './components/timer';

import React from 'react';
import ReactDOM from 'react-dom';


function Example() {
    return (
        <div className="container">
                <Timer.Clock />
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">ssssssssssss</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

if (document.getElementById('root')) {
    ReactDOM.render(<Example />, document.getElementById('root'));
}