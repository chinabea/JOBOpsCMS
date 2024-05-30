
<!-- Include the chat box HTML code in your layout file -->
<div id="chatBoxContainer" class="col-md-3" style="position: fixed; bottom: 20px; right: 20px; display: none; z-index: 9999;">
    <!-- DIRECT CHAT info -->
    <div class="card card-info direct-chat direct-chat-info shadow">
        <!-- Chat box content -->
        <div class="card-header">
            <h3 class="card-title">Messages</h3>
            <div class="card-tools">
                <span title="3 New Messages" class="badge bg-danger">3</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="{{ asset('dist/img/user3-128x128.jpg') }}" alt="Message User Image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                  <ul class="contacts-list">
                    <li>
                      <a href="#">
                        <img class="contacts-list-img" src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar">

                        <div class="contacts-list-info">
                          <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-right">2/28/2015</small>
                          </span>
                          <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                      </a>
                    </li>
                    <!-- End Contact Item -->
                  </ul>
                  <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
              </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <form action="#" method="post">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-info">Send</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->
</div>

<!-- Your existing content here -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get reference to the chat box container
        var chatBoxContainer = document.getElementById("chatBoxContainer");

        // Function to toggle chat box visibility
        function toggleChatBox() {
            if (chatBoxContainer.style.display === "none") {
                // Show the chat box
                chatBoxContainer.style.display = "block";
            } else {
                // Hide the chat box
                chatBoxContainer.style.display = "none";
            }
        }

        // Attach event listener to the link
        var chatLink = document.querySelector('a[href="https://m.me/332081713319212?ref=homepage"]');
        if (chatLink) {
            chatLink.addEventListener("click", function (event) {
                event.preventDefault(); // Prevent the default link behavior
                toggleChatBox();
            });
        }
    });
</script>

<!-- 
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get references to the button and chat box container
        var openChatButton = document.getElementById("openChatButton");
        var chatBoxContainer = document.getElementById("chatBoxContainer");

        // Toggle chat box visibility when the button is clicked
        openChatButton.addEventListener("click", function () {
            if (chatBoxContainer.style.display === "none") {
                // Show the chat box
                chatBoxContainer.style.display = "block";
            } else {
                // Hide the chat box
                chatBoxContainer.style.display = "none";
            }
        });
    });
</script> -->
