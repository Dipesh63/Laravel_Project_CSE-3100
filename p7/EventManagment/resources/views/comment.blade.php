<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .chat-container {
            width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        .messages {
            height: 300px;
            overflow-y: scroll;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .input-message {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn-send {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .message-label {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="chat-container">
        <h2 style="text-align: center;">Comment Section</h2>
        <form id="chat-form">
            @csrf

            <div class="messages" id="messages">
                <!-- Messages will appear here -->
                @foreach ($list as $item)
                    <div class="message-label">
                        <label>{{ $item->sender_name }}:</label> <!-- Display sender's name -->
                    </div>
                    <div class="message-label">
                        <label>{{ $item->msg }}.....</label> <!-- Change 'message' to 'msg' -->
                    </div>
                    <br>
                @endforeach
            </div>

            <input type="text" class="input-message" name="message" placeholder="Type your message..." required>
            <input type="hidden" name="event_id" value="{{ $eventid }}">
            <input type="hidden" name="sender_id" value="{{ $sender_id }}">
            <input type="hidden" name="sender_name" value="{{ $sender_name }}">
            <input type="hidden" name="organizer_id" value="{{ $organizer_id }}">
            <button type="submit" class="btn-send">Send</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#chat-form').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('event.storecomment') }}',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status) {
                            // Append the new message to the messages div
                            $('#messages').append('<div class="message-label"><label>' +
                                response.data.user_name +
                                ':</label></div><div class="message-label"><label>' +
                                response.data.message + '.....</label></div><br>');
                            $('input[name="message"]').val('');
                            $('#messages').scrollTop($('#messages')[0].scrollHeight); // Scroll to the bottom
                        } else {
                            alert('Failed to send message');
                        }
                    },
                    error: function() {
                        alert('An error occurred while sending the message');
                    }
                });
            });
        });
    </script>

</body>

</html>
