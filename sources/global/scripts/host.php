    <?php  
	
        $live_meetid = $fobrainLiveArr[1]["meetid"];                 
        $live_title = $fobrainLiveArr[1]["eTitle"];
        $eStaff = $fobrainLiveArr[1]["eStaff"];

        $participant = $fobrainLiveArr[1]["participant"];
        $eSubject = $fobrainLiveArr[1]["eSubject"]; 
        $eTime = $fobrainLiveArr[1]["eTime"];
        $cTime = $fobrainLiveArr[1]["cTime"];   

        $staff_info = staffData($conn, $eStaff);  /* school staffs/teachers information */							
        list ($title, $fullname, $sex, $srank, $pic, $lastname) =  explode ("#@s@#", $staff_info);	 
        $titleVal = wizSelectArray($title, $title_list);								
        $live_name = $titleVal.' '.$fullname;    
         
    ?> 
      
        let fob_api_key = "<?php echo $virtual_api_key ?>";
        let fobrain_name = "<?php echo $live_name; ?>";
        let fobrain_meetid = "<?php echo $live_meetid; ?>";
        let fobrain_title = "<?php echo $live_title; ?>";
        let fobrain_url = "<?php echo $fobrainPortalRoot; ?>"; 
        let return_url = "<?php echo $_SESSION['fobrainPilot']; ?>";

        $headerStudentPage
    
        var script = document.createElement("script");
        script.type = "text/javascript";
    
        script.addEventListener("load", function (event) { 

            //Get URL query parameters
            const url = new URLSearchParams(window.location.search);     

            const config = {
                
                name: fobrain_name,
                apiKey: fob_api_key, // generated from app.videosdk.live 
                meetingId: fobrain_meetid, // Get meeting id from params. 
              
                containerId: null, 

                micEnabled: true,
                webcamEnabled: true,
                participantCanToggleSelfWebcam: true,
                participantCanToggleSelfMic: true,
                participantCanLeave: true, // if false, leave button won't be visible

                redirectOnLeave: fobrain_url,

                chatEnabled: true,
                screenShareEnabled: true,
                pollEnabled: true,
                whiteboardEnabled: true,
                raiseHandEnabled: true,
                mode: "CONFERENCE", // VIEWER || CONFERENCE

               
                recording: {
                    enabled: true,
                    webhookUrl: "https://www.videosdk.live/callback",
                    // awsDirPath: `/meeting-recordings/${meetingId}/`, // Pass it only after configuring your S3 Bucket credentials on Video SDK dashboard
                    autoStart: false,
                    theme: "LIGHT", // DARK || LIGHT || DEFAULT

                    layout: {
                        type: "SIDEBAR", // "SPOTLIGHT" | "SIDEBAR" | "GRID"
                        priority: "PIN", // "SPEAKER" | "PIN",
                        gridSize: 3,
                    },
                },

                livestream: {
                    autoStart: false,
                    enabled: true,
                },

                hls: {
                    enabled: true,
                    autoStart: false,
                },

                theme: "LIGHT", // DARK || LIGHT || DEFAULT

                layout: {
                    type: "SPOTLIGHT", // "SPOTLIGHT" | "SIDEBAR" | "GRID"
                    priority: "PIN", // "SPEAKER" | "PIN",
                    // gridSize: 3,
                },

                branding: {
                    enabled: true,
                    logoURL:
                    "https://www.fobrain.com/app/logo.png",
                    name: "",
                    poweredBy: false,
                },

                waitingScreen: {
                    imageUrl: "https://www.fobrain.com/app/intro.jpg",
                    text: "Connecting to the class/meeting...",
                },

                videoConfig: {
                    resolution: "h1080p_w1920p", //h720p_w1280p, h360p_w640p, h540p_w960p, h1080p_w1920p
                    optimizationMode: "motion", // text , detail
                    multiStream: true,
                },

                audioConfig: {
                    quality: "high_quality",
                },

                screenShareConfig: {
                    resolution: "h720p_5fps", //h360p_30fps, h720p_5fps, h720p_15fps, h1080p_15fps, h1080p_30fps
                    optimizationMode: "text",
                },          

                permissions: {
                    pin: true,
                    askToJoin: false, // Ask joined participants for entry in meeting
                    toggleParticipantMic: true, // Can toggle other participant's mic
                    toggleParticipantWebcam: true, // Can toggle other participant's webcam
                    toggleParticipantScreenshare: true, // Can toggle other participant's screen share
                    toggleParticipantMode: true, // Can toggle other participant's mode
                    canCreatePoll: true, // Can create a poll
                    toggleHls: true, // Can toggle Start HLS button
                    drawOnWhiteboard: true, // Can draw on whiteboard
                    toggleWhiteboard: true, // Can toggle whiteboard
                    toggleVirtualBackground: true, // Can toggle virtual background
                    toggleRecording: true, // Can toggle meeting recording
                    toggleLivestream: true, //can toggle live stream
                    removeParticipant: true, // Can remove participant
                    endMeeting: true, // Can end meeting
                    changeLayout: true, //can change layout
                },

                joinScreen: {
                    visible: false, // Show the join screen ?
                    title: fobrain_title, // Meeting title
                    meetingUrl: window.location.href, // Meeting joining url
                },

                leftScreen: { 
                    rejoinButtonEnabled: true,
                },

                notificationSoundEnabled: true,

                debug: true, // pop up error during invalid config or netwrok error

                maxResolution: "hd", // "hd" or "sd"

            }; 

            const meeting = new VideoSDKMeeting();
            meeting.init(config);  

        }); 
    
        script.src =
        "https://sdk.videosdk.live/rtc-js-prebuilt/0.3.38/rtc-js-prebuilt.js";
        document.getElementsByTagName("head")[0].appendChild(script);
 