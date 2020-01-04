# Griffin-House
A youtube clone

<h3>Database detail</h3>
    <h5>📌 Database name</h5>
        griffin
    <h4>Tables name</h4>
        <ul>
            <li>
                categories            
                <ul>
                    <li>id</li>
                    <li>name</li>
                </ul>
            </li>
            <li>
                comments
                <ul>
                    <li>id</li>
                    <li>posted_by</li>
                    <li>video_id</li>
                    <li>response_to</li>
                    <li>body</li>
                    <li>created_at</li>
                </ul>
            </li>
            <li>
                dislikes
                <ul>
                    <li>id</li>
                    <li>username</li>
                    <li>commentid</li>
                    <li>videoid</li>
                </ul>
            </li>
            <li>
                likes
                <ul>
                    <li>id</li>
                    <li>username</li>
                    <li>commentid</li>
                    <li>videoid</li>
                </ul>
            </li>
            <li>
                subscribers
                <ul>
                    <li>id</li>
                    <li>user_to</li>
                    <li>user_from</li>
                </ul>
            </li>
            <li>
                thumbnails
                <ul>
                    <li>id</li>
                    <li>video_id</li>
                    <li>url</li>
                    <li>selected</li>
                    <li>created_at</li>
                </ul>
            </li>
            <li>
                users
                <ul>
                    <li>id</li>
                    <li>username</li>
                    <li>firstname</li>
                    <li>lastname</li>
                    <li>email</li>
                    <li>password</li>
                    <li>created_at</li>
                    <li>profile</li>
                </ul>
            </li>
            <li>
                videos
                <ul>
                    <li>id</li>
                    <li>username</li>
                    <li>title</li>
                    <li>description</li>
                    <li>category</li>
                    <li>privacy</li>
                    <li>url</li>
                    <li>created_at</li>
                    <li>views</li>
                    <li>duration</li>
                </ul>
            </li>
        </ul>
        
This is databse detail of our project.<br>
Some tables have <b>created_at</b> field and it's default value is <b>CURRUNT_TIMESTAMP</b>.<br>
Make sure that the tables and fields name must same otherwise you have to refactor each and every querys and other statements.<br>
Otherwise just import database named griffin (1).sql.<br>