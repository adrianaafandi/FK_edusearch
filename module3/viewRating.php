<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .question-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f1f1f1;
        }

        .name {
            margin-left: 10px;
            font-weight: bold;
        }

        .answer-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            background-color: #eaeaea;
        }

        .answer-button {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .rating {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            display: inline-block;
            cursor: pointer;
            color: #888;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked~label {
            color: gold;
        }
    </style>
    <title>FK_EDUSEARCH</title>
</head>

<body>
    <?php include '../ExpertSideBar/Expert_sidebar.php'; ?>
    <div class="answer-button">
        <button type="submit" class="btn btn-primary">VIEW RATING</button>
    </div>

    <div class="card-body">
        <form>

            <div class="question-box">
                <i class="fas fa-user-circle"></i>
                <span class="name">John Doe</span>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required checked />
                    <input type="radio" id="star5-john" name="rating-john" value="5" required checked />
                    <label for="star5-john" title="5 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star4-john" name="rating-john" value="4" required />
                    <label for="star4-john" title="4 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star3-john" name="rating-john" value="3" required />
                    <label for="star3-john" title="3 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star2-john" name="rating-john" value="2" required />
                    <label for="star2-john" title="2 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star2-john" name="rating-john" value="2" required />
                    <label for="star2-john" title="2 stars"><i class="fas fa-star"></i></label>


                </div>
                <div class="answer-box">
                    <p><strong>Question:</strong> What is the purpose of software architecture, and how does it impact the development process?</p>
                    <p><strong>Answer:</strong> It helps stakeholders understand the overall structure and behavior of the software system.</p>
                </div>
            </div>

            <div class="question-box">
                <i class="fas fa-user-circle"></i>
                <span class="name">Felix</span>
                <div class="rating">
                    <input type="radio" id="star5-felix" name="rating-felix" value="5" required />
                    <label for="star5-felix" title="5 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star4-felix" name="rating-felix" value="4" required checked />
                    <label for="star4-felix" title="4 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star3-felix" name="rating-felix" value="3" required />
                    <label for="star3-felix" title="3 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star2-felix" name="rating-felix" value="2" required />
                    <label for="star2-felix" title="2 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star1-felix" name="rating-felix" value="1" required />
                    <label for="star1-felix" title="1 star"><i class="fas fa-star"></i></label>
                </div>
                <div class="answer-box">
                    <p><strong>Question:</strong>What is the purpose of server-side scripting? Provide examples of server-side scripting languages.</p>
                    <p><strong>Answer:</strong> Examples of server-side scripting languages include: PHP,Phyton, Node.js and Java.</p>
                </div>
            </div>

            <div class="question-box">
                <i class="fas fa-user-circle"></i>
                <span class="name">Karina</span>
                <div class="rating">
                    <input type="radio" id="star5-karina" name="rating-karina" value="5" required />
                    <label for="star5-karina" title="5 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star4-karina" name="rating-karina" value="4" required />
                    <label for="star4-karina" title="4 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star3-karina" name="rating-karina" value="3" required checked />
                    <label for="star3-karina" title="3 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star2-karina" name="rating-karina" value="2" required />
                    <label for="star2-karina" title="2 stars"><i class="fas fa-star"></i></label>

                    <input type="radio" id="star1-karina" name="rating-karina" value="1" required />
                    <label for="star1-karina" title="1 star"><i class="fas fa-star"></i></label>
                </div>
                <div class="answer-box">
                    <p><strong>Question:</strong>How do you handle database connection errors or failures in a web application?</p>
                    <p><strong>Answer:</strong> Implement a robust logging mechanism to capture and log any database connection errors or failures. This will help in identifying the root cause of the issue and assist in troubleshooting..</p>
                </div>
            </div>

        </form>
    </div>
</body>

</html>