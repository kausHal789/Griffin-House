# Griffin-House
A youtube clone

<h3>Database detail</h3>
    <h5>📌 Database name</h5>
        griffin
    <h4>Tables name</h4>
        <ul>
            <li>
                1️⃣ categories            
                <ul>
                    <li>id</li>
                    <li>name</li>
                </ul>
            </li>
            <li></li>
            <li></li>
        </ul>
        2️⃣ comments
            id
            posted_by
            video_id
            response_to
            body
            created_at
        3️⃣ dislikes
            id
            username
            commentid
            videoid
        4️⃣ likes
            id
            username
            commentid
            videoid
        5️⃣ subscribers
            id
            user_to
            user_from
        6️⃣ thumbnails
            id 
            video_id
            url
            selected
            created_at
        7️⃣ users
            id
            username
            firstname
            lastname
            email
            password
            created_at
            profile
        8️⃣ videos
            id 
            username
            title
            description
            category
            privacy
            url
            created_at
            views
            duration
        
This is databse detail of our project
Make sure that the tables and fields name must same otherwise you need to change in all places
