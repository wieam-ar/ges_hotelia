<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background-color:rgb(0, 0, 0) ;
            height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .comment-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 480px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .comment-count {
            background: #ffd700;
            color: #333;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .close-btn {
            text-decoration: none;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #666;
            padding: 4px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .close-btn:hover {
            background: #f5f5f5;
        }

        .comments-list {
            flex: 1;
            overflow-y: auto;
            padding: 0 24px;
        }

        .comment {
            padding: 16px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .comment:last-child {
            border-bottom: none;
        }

        .comment-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(45deg, rgb(195, 200, 226), rgb(255, 238, 0));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .comment-info {
            flex: 1;
        }

        .username {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
        }

        .timestamp {
            color: #666;
            font-size: 12px;
            margin-left: 8px;
        }

        .comment-text {
            color: #333;
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        .comment-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .action-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 12px;
            cursor: pointer;
            padding: 4px 0;
            transition: color 0.2s;
        }

        .action-btn:hover {
            color: #333;
        }

        .like-btn {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .like-btn.liked {
            color: #e74c3c;
        }

        .heart {
            font-size: 14px;
        }

        .comment-input-container {
            padding: 16px 24px 20px;
            border-top: 1px solid #f0f0f0;
            background: #fafafa;
        }

        .input-wrapper {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .comment-input {
            flex: 1;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            padding: 12px 16px;
            font-size: 14px;
            resize: none;
            outline: none;
            transition: border-color 0.2s;
            min-height: 40px;
            max-height: 100px;
        }

        .comment-input:focus {
            border-color: rgb(21, 21, 22);
        }

        .send-btn {
            background: rgb(0, 0, 0);
            border: none;
            border-radius: 20px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
            color: white;
        }

        .send-btn:hover {
            background: #5a6fd8;
        }

        .send-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .reply-input {
            margin-top: 12px;
            padding-left: 48px;
            display: none;
        }

        .reply-input.show {
            display: block;
        }

        .reply-input .input-wrapper {
            margin-bottom: 0;
        }

        .replies {
            margin-left: 48px;
            margin-top: 12px;
        }

        .reply {
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .reply:last-child {
            border-bottom: none;
        }

        /* Scrollbar styling */
        .comments-list::-webkit-scrollbar {
            width: 6px;
        }

        .comments-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .comments-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .comments-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body>
    <div class="comment-container">
        <div class="header">
            <h2>
                Comments
                <span class="comment-count" id="commentCount">4</span>
            </h2>
            <a href="index.php" class="close-btn">×</a>
        </div>

        <div class="comments-list" id="commentsList">
            <div class="comment" data-id="1">
                <div class="comment-header">
                    <div class="avatar">DR</div>
                    <div class="comment-info">
                        <span class="username">Donald Rice</span>
                        <span class="timestamp">5 min ago</span>
                    </div>
                </div>
                <div class="comment-text">Christian spirit passion virtues suicide morality. Pinnacle moral pinnacle hope abstract right disgust joy.</div>
                <div class="comment-actions">
                    <button class="action-btn reply-btn" onclick="toggleReplyInput(1)">Reply</button>
                    <button class="action-btn">You Like</button>
                    <button class="action-btn like-btn liked" onclick="toggleLike(this)">
                        <span class="heart">♥</span>
                        <span class="like-count">24</span>
                    </button>
                </div>
                <div class="reply-input" id="replyInput1">
                    <div class="input-wrapper">
                        <textarea class="comment-input" placeholder="Write a reply..." rows="1"></textarea>
                        <button class="send-btn" onclick="addReply(1)">→</button>
                    </div>
                </div>
            </div>

            <div class="comment" data-id="2">
                <div class="comment-header">
                    <div class="avatar">VA</div>
                    <div class="comment-info">
                        <span class="username">Victoria Alexander</span>
                        <span class="timestamp">15 min ago</span>
                    </div>
                </div>
                <div class="comment-text">War moral madness enlightenment aversion oneself! Inasmuch ascetic eternal return dead suicide. Overcome society noble love.</div>
                <div class="comment-actions">
                    <button class="action-btn reply-btn" onclick="toggleReplyInput(2)">Reply</button>
                    <button class="action-btn">Like?</button>
                    <button class="action-btn like-btn" onclick="toggleLike(this)">
                        <span class="heart">♡</span>
                        <span class="like-count">13</span>
                    </button>
                </div>
                <div class="reply-input" id="replyInput2">
                    <div class="input-wrapper">
                        <textarea class="comment-input" placeholder="Write a reply..." rows="1"></textarea>
                        <button class="send-btn" onclick="addReply(2)">→</button>
                    </div>
                </div>
            </div>

            <div class="comment" data-id="3">
                <div class="comment-header">
                    <div class="avatar">ER</div>
                    <div class="comment-info">
                        <span class="username">Elmer Roberts</span>
                        <span class="timestamp">25 min ago</span>
                    </div>
                </div>
                <div class="comment-text">Value salvation intentions overcome value merciful. Spirit god christian contradict.</div>
                <div class="comment-actions">
                    <button class="action-btn reply-btn" onclick="toggleReplyInput(3)">Reply</button>
                    <button class="action-btn">Like?</button>
                    <button class="action-btn like-btn" onclick="toggleLike(this)">
                        <span class="heart">♡</span>
                        <span class="like-count">4</span>
                    </button>
                </div>
                <div class="reply-input" id="replyInput3">
                    <div class="input-wrapper">
                        <textarea class="comment-input" placeholder="Write a reply..." rows="1"></textarea>
                        <button class="send-btn" onclick="addReply(3)">→</button>
                    </div>
                </div>
            </div>

            <div class="comment" data-id="4">
                <div class="comment-header">
                    <div class="avatar">LH</div>
                    <div class="comment-info">
                        <span class="username">Leah Horton</span>
                        <span class="timestamp">45 min ago</span>
                    </div>
                </div>
                <div class="comment-text">Revaluation grandeur hope chaos christian grandeur convictions passion merciful pious.</div>
                <div class="comment-actions">
                    <button class="action-btn reply-btn" onclick="toggleReplyInput(4)">Reply</button>
                    <button class="action-btn">Like?</button>
                    <button class="action-btn like-btn" onclick="toggleLike(this)">
                        <span class="heart">♡</span>
                        <span class="like-count">17</span>
                    </button>
                </div>
                <div class="reply-input" id="replyInput4">
                    <div class="input-wrapper">
                        <textarea class="comment-input" placeholder="Write a reply..." rows="1"></textarea>
                        <button class="send-btn" onclick="addReply(4)">→</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="comment-input-container">
            <div class="input-wrapper">
                <textarea class="comment-input" id="mainCommentInput" placeholder="Type a comment..." rows="1"></textarea>
                <button class="send-btn" id="mainSendBtn" onclick="addComment()">→</button>
            </div>
        </div>
    </div>

    <script>
        let commentIdCounter = 5;

        // Auto-resize textarea
        document.querySelectorAll('.comment-input').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';

                // Enable/disable send button based on content
                const sendBtn = this.parentNode.querySelector('.send-btn');
                sendBtn.disabled = !this.value.trim();
            });
        });

        function toggleReplyInput(commentId) {
            const replyInput = document.getElementById(`replyInput${commentId}`);
            const isVisible = replyInput.classList.contains('show');

            // Hide all other reply inputs
            document.querySelectorAll('.reply-input').forEach(input => {
                input.classList.remove('show');
            });

            // Toggle current reply input
            if (!isVisible) {
                replyInput.classList.add('show');
                replyInput.querySelector('.comment-input').focus();
            }
        }

        function toggleLike(button) {
            const isLiked = button.classList.contains('liked');
            const heart = button.querySelector('.heart');
            const countSpan = button.querySelector('.like-count');
            let count = parseInt(countSpan.textContent);

            if (isLiked) {
                button.classList.remove('liked');
                heart.textContent = '♡';
                count--;
            } else {
                button.classList.add('liked');
                heart.textContent = '♥';
                count++;
            }

            countSpan.textContent = count;
        }

        function addComment() {
            const input = document.getElementById('mainCommentInput');
            const text = input.value.trim();

            if (!text) return;

            const commentsList = document.getElementById('commentsList');
            const newComment = createCommentElement(commentIdCounter, 'You', 'now', text);

            commentsList.insertBefore(newComment, commentsList.firstChild);
            input.value = '';
            input.style.height = 'auto';

            updateCommentCount();
            commentIdCounter++;
        }

        function addReply(parentCommentId) {
            const replyInput = document.getElementById(`replyInput${parentCommentId}`);
            const textarea = replyInput.querySelector('.comment-input');
            const text = textarea.value.trim();

            if (!text) return;

            const parentComment = document.querySelector(`[data-id="${parentCommentId}"]`);
            let repliesContainer = parentComment.querySelector('.replies');

            if (!repliesContainer) {
                repliesContainer = document.createElement('div');
                repliesContainer.className = 'replies';
                parentComment.appendChild(repliesContainer);
            }

            const replyElement = createReplyElement('You', 'now', text);
            repliesContainer.appendChild(replyElement);

            textarea.value = '';
            textarea.style.height = 'auto';
            replyInput.classList.remove('show');

            updateCommentCount();
        }

        function createCommentElement(id, username, timestamp, text) {
            const comment = document.createElement('div');
            comment.className = 'comment';
            comment.setAttribute('data-id', id);

            const initials = username.split(' ').map(n => n[0]).join('').toUpperCase();

            comment.innerHTML = `
                <div class="comment-header">
                    <div class="avatar">${initials}</div>
                    <div class="comment-info">
                        <span class="username">${username}</span>
                        <span class="timestamp">${timestamp}</span>
                    </div>
                </div>
                <div class="comment-text">${text}</div>
                <div class="comment-actions">
                    <button class="action-btn reply-btn" onclick="toggleReplyInput(${id})">Reply</button>
                    <button class="action-btn">Like?</button>
                    <button class="action-btn like-btn" onclick="toggleLike(this)">
                        <span class="heart">♡</span>
                        <span class="like-count">0</span>
                    </button>
                </div>
                <div class="reply-input" id="replyInput${id}">
                    <div class="input-wrapper">
                        <textarea class="comment-input" placeholder="Write a reply..." rows="1"></textarea>
                        <button class="send-btn" onclick="addReply(${id})">→</button>
                    </div>
                </div>
            `;

            // Add event listeners for the new textarea
            const textarea = comment.querySelector('.comment-input');
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 100) + 'px';

                const sendBtn = this.parentNode.querySelector('.send-btn');
                sendBtn.disabled = !this.value.trim();
            });

            return comment;
        }

        function createReplyElement(username, timestamp, text) {
            const reply = document.createElement('div');
            reply.className = 'reply';

            const initials = username.split(' ').map(n => n[0]).join('').toUpperCase();

            reply.innerHTML = `
                <div class="comment-header">
                    <div class="avatar" style="width: 28px; height: 28px; font-size: 12px;">${initials}</div>
                    <div class="comment-info">
                        <span class="username">${username}</span>
                        <span class="timestamp">${timestamp}</span>
                    </div>
                </div>
                <div class="comment-text">${text}</div>
                <div class="comment-actions">
                    <button class="action-btn">Like?</button>
                    <button class="action-btn like-btn" onclick="toggleLike(this)">
                        <span class="heart">♡</span>
                        <span class="like-count">0</span>
                    </button>
                </div>
            `;

            return reply;
        }

        function updateCommentCount() {
            const comments = document.querySelectorAll('.comment').length;
            const replies = document.querySelectorAll('.reply').length;
            document.getElementById('commentCount').textContent = comments + replies;
        }

        // Handle Enter key for sending comments
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                const activeElement = document.activeElement;
                if (activeElement.classList.contains('comment-input')) {
                    e.preventDefault();
                    const sendBtn = activeElement.parentNode.querySelector('.send-btn');
                    if (!sendBtn.disabled) {
                        sendBtn.click();
                    }
                }
            }
        });

        // Initialize send button states
        document.querySelectorAll('.send-btn').forEach(btn => {
            btn.disabled = true;
        });
    </script>
</body>

</html>