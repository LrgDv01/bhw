@if (auth()->user()->isAdmin())
    @include('admin.partials.__header')
    @include('admin.partials.__nav')
@else
    @include('user.partials.__header')
    @include('user.partials.__nav')
@endif
<style>
    #screenShare {
        /* margin-top: 20px; */
        width: 80%;
    }

    audio {
        display: none;
    }
    #videoContainer {
        width: 100vw;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row; /* Default direction is row */
    
    }
    
    @media (max-width: 767px) {
        #videoContainer {
            flex-direction: column; /* Change direction to column on mobile */
        }
    }
    #videoContainer > div {
      border: "1px solid red ";
      /* max-width: 33.33%; */
      height: 100%;
      flex: 1 1 33.3333%;
    }
</style>
<main id="main" class="main">

    <section class="section dashboard">
        <div class="text-center">
            <h4 class="fw-bold">VIRTUAL VISIT</h4>
            <div id="countdown-timer">00:00</div>
        </div>
    </section>
    
    @if (!auth()->user()->isAdmin())
        <input type="hidden" id="is_visitor" value="yes">
    @endif
    
    <!--join page container start-->
    <div id="joinPage" class="main-bg p-3">
        <div class="row">
            <div class="col-lg-7">
                <div class="join-left">
                    <div class="video-view">
                        <video class="video" id="joinCam"
                            style="
                              width: 100%;
                              height: 100%;
                              border-radius: 10px;
                              transform: rotate('90');
                              object-fit: cover;
                              box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19),
                              0 6px 6px rgba(0, 0, 0, 0.23);
                        "></video>
                        <div class="input-group mb-3 video-content">
                            <button class="btn btn-primary" style="height: 50px; width: 50px; background-color: red;"
                                id="camButton" onclick="toggleWebCam()">
                                <i class="bi bi-camera-video-fill" style="color: black; font-size: 21px; display: none"
                                    id="onCamera"></i>
                                <i class="bi bi-camera-video-off-fill" style="color: black; font-size: 21px; "
                                    id="offCamera"></i>
                            </button>
                            <button
                                class="btn btn-primary" 
                                style="
                                  height: 50px;
                                  width: 50px;
                                  margin-left: 5px;
                                  background-color: red;
                                "
                                id="micButton" onclick="toggleMic()">
                                <i class="bi bi-mic-mute-fill" style="color: black; font-size: 21px;"
                                    id="muteMic"></i>
                                <i class="bi bi-mic-fill" style="color: black; font-size: 21px; display: none"
                                    id="unmuteMic"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="mb-3">
                    <label>Camera</label>
                    <select style="column-span: 3;" class="form-select" id="cameraDeviceDropDown"
                        onchange="enableCam()"></select>
                </div>
                <div class="mb-3">
                    <label>Microphone</label>
                    <select style="column-span: 3;" class="form-select" id="microphoneDeviceDropDown"></select>
                </div>
                <div class="mb-3">
                    <label>Speakers</label>
                    <select style="column-span: 3;" class="form-select" id="playBackDeviceDropDown"></select>
                </div>
                <div class="join-right">
                    @if (auth()->user()->isAdmin())
                    <div class="">
                      <button class="btn btn-primary w-100 meetingJoinButton"
                          onclick="joinMeeting(true)" disabled> 
                          Create Meeting
                      </button>
                    </div>
                    <div>
                      <br />
                      <center style="color: grey">OR</center>
                      <br />
                    </div>
                    @endif
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="bi bi-keyboard-fill"></i></span>
                      <input type="text" class="form-control" id="joinMeetingId" value="{{ $code ?? '' }}" placeholder="Enter Meeting Code" />
                      <button class="btn btn-primary meetingJoinButton"
                          onclick="joinMeeting(false)" disabled>
                          Join Meeting
                      </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid-page flex-container" id="gridPpage" style="display:none;">
        <div class="row" style="width: 100%; border-bottom: 1px solid grey">
            <div class="col-lg-3 d-flex justify-content-start mb-3">
                <input type="text" class="form-control form-control-sm" value="asdjhkasd" id="meetingid" readonly />
                <button id="btnCopy" type="button" title="Copy Meeting Code" class="btn btn-sm btn-primary" onclick="copyMeetingCode()">
                    <span class="material-icons"> content_copy </span>
                </button>
            </div>

            <div class="col-lg-9" style="position: static; align-content: right">
                <div class="d-flex justify-content-end">
                    <button type="button" id="btnStartRecording" class="btn">
                        <span class="material-icons"> radio_button_checked </span>
                    </button>
                    <button type="button" style="display: none" id="btnStopRecording" class="btn btn-light">
                        <span class="material-icons"> radio_button_checked </span>
                    </button>
                    <button type="button" id="btnRaiseHand" class="btn ms-1">
                        <span class="material-icons"> front_hand </span>
                    </button>
                    <span class="vertical-line"></span>

                    <!-- main page toggle mic-->
                    <div class="btn-group" id="main-pg-mute-mic" style="display: inline-block">
                        <button type="button" class="btn dropdown-toggle ms-1"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="material-icons"> mic_off </span>
                        </button>
                    </div>
                    <div class="btn-group" id="main-pg-unmute-mic" style="display: none">
                        <button type="button" class="btn ms-1" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="material-icons"> mic </span>
                        </button>

                    </div>
                    <!--main page toggle web-cam-->
                    <div class="btn-group" id="main-pg-cam-off" style="display: inline-block">
                        <button type="button" class="btn ms-1" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="material-icons"> videocam_off</span>
                        </button>
                    </div>
                    <div class="btn-group" id="main-pg-cam-on" style="display: none">
                        <button type="button" class="btn ms-1" aria-haspopup="true"
                            aria-expanded="false" id="videoCamOn">
                            <span class="material-icons"> videocam </span>
                        </button>
                    </div>
                    <!--screen share-->
                    <button type="button" id="btnScreenShare" class="btn ms-1" style="display: none">
                        <span class="material-icons"> screen_share </span>
                    </button>
                    <span class="vertical-line"></span>
                    <!--participants-->
                    <button type="button" class="btn ms-1" onclick="openParticipantWrapper()">
                        <span class="material-icons"> people </span>
                    </button>
                    <!--chat-->
                    <button type="button" class="btn ms-1" onclick="openChatWrapper()" style="display: none">
                        <span class="material-icons"> chat </span>
                    </button>
                    <span class="vertical-line"></span>
                    <!--call end-->
                    <div class="btn-group">
                      <div class="dropdown open">
                        <button
                          class="btn btn-danger dropdown-toggle"
                          type="button"
                          id="triggerId"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          Call End
                        </button>
                        <div class="dropdown-menu" aria-labelledby="triggerId">
                          <button type="button" class="dropdown-item" id="endCall">End Call</button>
                          <button type="button" class="dropdown-item" id="leaveCall">Leave Meeting</button>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <video id="videoScreenShare" style="display: none"></video>
        <div class="row mt-3">
          <div class="col-lg-10">
            <div class="row w-100" id="videoContainer"></div>
          </div>
          <div class="col-lg-2" id="participants" style="display: none">
              <!--participant wrapper-->
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 id="totalParticipants"></h5>
                    <span id="ParticipantsCloseBtn" onclick="closeParticipantWrapper()">&times;</span>
                </div>
                <div class="card-body">
                  <div id="participantsList" class=""></div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <!--raise hand pop-up-->
    <div id="contentRaiseHand" class="alert alert-info col-2"
        style="
        left: 10;
        bottom: 0;
        position: absolute;
        height: 60px;
        display: none;
      "
        role="alert"></div>


    <!--chat wrapper-->
    {{-- <div class="chat-wrapper" id="chatModule">
        <div class="chat-wrapper-header text-light">
            <span class="closebtn" id="chatCloseBtn" onclick="closeChatWrapper()">&times;</span>
            <h5 id="chatHeading">Let's Chat!</h5>
        </div>
        <hr class="border-light rounded 3" />
        <div id="chatArea" class="chat-wrapper-content text-light" style="overflow-y: scroll"></div>
        <div class="message-box input-group mb-2">
            <input type="text" id="txtChat" class="form-control" placeholder="Message..." />
            <div id="btnSend" class="input-group-append">
                <button class="btn btn-primary">Send</button>
            </div>
        </div>
    </div> --}}
    <div id="viewer"></div>
</main>
@if (auth()->user()->isAdmin())
@include('admin.partials.__footer')
@else 
@include('user.partials.__footer')
@endif
