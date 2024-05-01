<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;


class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = [

               // A

            [
                'name' => 'Abdominal Crunches ',
                'description' => 'Lie on your back with your knees bent and your arms stretched forward.
                Then lift your upper body off the floor. Hold for a few seconds and slowly return.
                It primarily works the rectus abdominis muscle and the obliques.',
                'gif' => 'public/seed_GIFs/Abdominal-Crunches-.gif',
                'calories' => 100,
            ],
            [
                'name' => 'Alternating Hooks ',
                'description' => 'Stand with your feet shoulder-width apart, and place your dominant foot slightly forward. Slightly bend your knees, clench your fists and bend your elbows at 90 degrees.

                Raise your right arm to shoulder height and keep your forearm parallel to the ground. Rotate your shoulders and hips and punch towards the left. Switch sides and repeat.',
                'gif' => 'public/seed_GIFs/Alternating-Hooks-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Circles ',
                'description' => 'Stand on the floor with your arms extended straight out to the sides at shoulder height.

                Move your arms forward in circles, and then move backwards.',
                'gif' => 'public/seed_GIFs/Arm-Circles-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Circles Clockwise ',
                'description' => 'Stand on the floor with your arms extended straight out to the sides at shoulder height.
                Move your arms clockwise in circles fast.
                Try to do it as fast as you can.
                It is a great exercise for the deltoid muscle.',
                'gif' => 'public/seed_GIFs/Arm-Circles-Clockwise-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Circles CounterClockwise ',
                'description' => 'Stand on the floor with your arms extended straight out to the sides at shoulder height.
                Move your arms counterclockwise in circles fast.
                Try to do it as fast as you can.
                It is a great exercise for the deltoid muscle.',
                'gif' => 'public/seed_GIFs/Arm-Circles-CounterClockwise-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Curls Crunch Left ',
                'description' => 'Lie on your left side with your knees bent and lifted. Grasp your left thigh with your left hand and put your right hand behind your head.

                Then raise your upper body by pulling your left thigh. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Arm-Curls-Crunch-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Curls Crunch Right ',
                'description' => 'Lie on your right side with your knees bent and lifted. Grasp your right thigh with your right hand and put your left hand behind your head.

                Then raise your upper body by pulling your right thigh. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Arm-Curls-Crunch-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Raises ',
                'description' => 'Stand on the floor with your arms extended
                straight forward at shoulder height.
                Exhale, raise your arms above your head. Inhale, return to the start position and repeat.',
                'gif' => 'public/seed_GIFs/Arm-Raises-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Arm Scissors ',
                'description' => 'Stand upright with your feet shoulder width apart.

                Stretch your arms in front of you at shoulder height with one arm overlap the other in the shape of the letter "X", and then spread them apart.

                Switch arms, and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Arm-Scissors-.gif',
                'calories' => 150,
            ],

               // B

            [
                'name' => 'Backward Lunge ',
                'description' => 'Stand with your feet shoulder width apart and your hands on your hips.

                Step a big step backward with your right leg and lower your body until your left thigh is parallel to the floor. Return and repeat with the other side.',
                'gif' => 'public/seed_GIFs/Backward-Lunge-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Bicycle Crunches ',
                'description' => 'Lie on the floor with your hands behind your ears. Raise your knees and close your right elbow toward your left knee, then close your left elbow toward your right knee. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Bicycle-Crunches-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Bottom Leg Lift Left ',
                'description' => 'Lie on your left side with your head resting on your left hand.

                Then put your right foot forward on the floor. Lift your left leg up and down.',
                'gif' => 'public/seed_GIFs/Bottom-Leg-Lift-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Bottom Leg Lift Right ',
                'description' => 'Lie on your right side with head resting on your right hand.

                Then put your left foot forward on the floor. Lift your right leg up and down.',
                'gif' => 'public/seed_GIFs/Bottom-Leg-Lift-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Box Push-ups ',
                'description' => 'Start on all fours with your knees under your butt and your hands directly under your shoulders.

                Bend your elbows and do a push-up. Return to the start position and repeat.',
                'gif' => 'public/seed_GIFs/Box-Push-ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Burpees ',
                'description' => 'Stand with your feet shoulder width apart, then put your hands on the ground and kick your feet backward. Do a quick push-up and then jump up.',
                'gif' => 'public/seed_GIFs/Burpees-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Butt Bridge ',
                'description' => 'Lie on your back with knees bent and feet flat on the floor. Put your arms flat at your sides.

                Then lift your butt up and down.',
                'gif' => 'public/seed_GIFs/Butt-Bridge-.gif',
                'calories' => 150,
            ],

                // C

            [
                'name' => 'Calf Raise With Splayed Foot ',
                'description' => 'Description of Exercise 2',
                'gif' => 'public/seed_GIFs/Calf-Raise-With-Splayed-Foot-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Calf Stretch Left ',
                'description' => 'Stand one big step away in front of a wall. Step forward with your right foot and push the wall with your hands.

                Please make sure your left leg is fully extended and you can feel your left calf stretching. Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Calf-Stretch-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Calf Stretch Right ',
                'description' => 'Stand one big step away in front of a wall. Step forward with your left foot and push the wall with your hands.

                Please make sure your right leg is fully extended and you can feel your right calf stretching. Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Calf-Stretch-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Cat Cow Pose ',
                'description' => 'Start on all fours with your knees under your butt and your hands directly under your shoulders.

                Then take a breath and make your belly fall down, shoulders roll back and head come up towards the ceiling.

                As you exhale, curve your back upward and let your head come down. Repeat the exercise.

                Do it slowly with each step of this exercise.',
                'gif' => 'public/seed_GIFs/Cat-Cow-Pose-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Chest Press Pulse ',
                'description' => 'Hold your forearms together at shoulder height
                and bend your elbows with your hands together to
                make an L shape.
                Then lift your forearms up and down.',
                'gif' => 'public/seed_GIFs/Chest-Press-Pulse-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Chest Stretch ',
                'description' => 'Find a doorway, take a lunge position in the doorway with your arms on the doorframe and your elbows a little lower than your shoulders, then slowly bring your chest forward.
                Hold this position for 30-40 seconds. Then slowly come out of it, bring your arms down and do a couple of shoulder rolls.
                Do not pull your head forward, and keep your neck relaxed.',
                'gif' => 'public/seed_GIFs/Chest-Stretch-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Childs pose ',
                'description' => 'Start with your knees and hands on the floor. Put your hands a little forward, widen your knees and put your toes together.

                Take a breath, then exhale and sit back. Try to make your butt touch your heels. Relax your elbows, make your forehead touch the floor and try to lower your chest close to the floor. Hold this position.

                Keep your arms stretched forward as you sit back. Make sure there is enough space between your shoulders and ears during the exercise.',
                'gif' => 'public/seed_GIFs/Childs-pose-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Cobra Stretch ',
                'description' => 'Lie down on your stomach and bend your elbows with your hands beneath your shoulders.
                Then push your chest up off the ground as far as possible. Hold this position for seconds.',
                'gif' => 'public/seed_GIFs/Cobra-Stretch-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Crossover Crunch ',
                'description' => 'Lie on your back with your knees bent and your hands behind your ears.

                Raise and twist your torso so your right elbow moves to meet your left knee. Repeat with the other side.',
                'gif' => 'public/seed_GIFs/Crossover-Crunch-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Curtsy Lunges ',
                'description' => 'Stand straight up. Then step back with your left leg to the right, and bend your knees at the same time.

                Go back to the start position and switch to the other side.',
                'gif' => 'public/seed_GIFs/Curtsy-Lunges-.gif',
                'calories' => 150,
            ],

                // D

            [
                'name' => 'Decline Push ups ',
                'description' => 'Start on all fours with your knees under your butt and your hands under your shoulders.

                Then elevate your feet on a chair or bench, and push your body up and down mainly using your arm strength.

                Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Decline-Push-ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Diagonal Plank ',
                'description' => 'Start in the straight arm plank position.
                Lift your right arm and left leg until they are
                parallel with the ground.
                Return to the start position and repeat with the
                other side.',
                'gif' => 'public/seed_GIFs/Diagonal-Plank-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Diamond Push ups ',
                'description' => 'Start in the push-up position. Make a diamond shape with your forefingers and thumbs together under your chest.
                Then push your body up and down. Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Diamond-Push-ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Donkey Kicks Left ',
                'description' => 'Start on all fours with your knees under your butt and your hands under your shoulders.

                Then lift your left leg and squeeze your butt as much as you can. Go back to the start position and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Donkey-Kicks-Left.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Donkey Kicks Right ',
                'description' => 'Start on all fours with your knees under butt and your hands under shoulders.

                Then lift your right leg and squeeze your butt as much as you can. Go back to the start position and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Donkey-Kicks-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Doorway Curls Left ',
                'description' => 'Stand in a doorway. Grasp the doorframe using your left hand, and put your feet close to the bottom of the door.

                Extend your left arm and lean back, then pull at the doorframe and come back to the starting position. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Doorway-Curls-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Doorway Curls Right ',
                'description' => 'Stand in a doorway. Grasp the doorframe using your right hand, and put your feet close to the bottom of the door.

                Extend your right arm and lean back, then pull at the doorframe and come back to the starting position. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Doorway-Curls-Right-.gif',
                'calories' => 150,
            ],

                //F

            [
                'name' => 'Fire Hydrant Left ',
                'description' => 'Start on all fours with your knees under your butt and your hands under your shoulders.

                Then lift your left leg to the side at a 90 degree angle.',
                'gif' => 'public/seed_GIFs/Fire-Hydrant-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Fire Hydrant Right ',
                'description' => 'Start on all fours with your knees under your butt and your hands under your shoulders.

                Then lift your right leg to the side at a 90 degree angle.',
                'gif' => 'public/seed_GIFs/Fire-Hydrant-Right.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Floor Tricep Dips ',
                'description' => 'Sit on the floor with your knees bent and feet flat on the floor. Put your hands beneath your shoulders with your fingers pointing toward your hips.

                Lift your hips off the floor. Then bend and extend your elbows to lower and lift your hips.

                Repeat the exercise to strengthen your upper arms.',
                'gif' => 'public/seed_GIFs/Floor-Tricep-Dips-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Floor Y Raises ',
                'description' => 'Lie face down on the floor with your arms fully extended and your thumbs pointing up, your body should be in the shape of the letter "Y".

                Raise your arms off the ground as far as you can and pause them at the top for 2 seconds. Slowly go back to the start position, and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Floor-Y-Raises-.gif',
                'calories' => 150,
            ],

                // G

            [
                'name' => 'Glute Kick Back Left ',
                'description' => 'Start on all fours with your knees under your butt and your hands directly under your shoulders.

                Then kick one leg back until it is parallel with the ground. Switch to the other side after several sets.',
                'gif' => 'public/seed_GIFs/Glute-Kick-Back-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Glute Kick Back Right ',
                'description' => 'Start on all fours with your knees under your butt and your hands directly under your shoulders.

                Then kick one leg back until it is parallel with the ground. Switch to the other side after several sets.',
                'gif' => 'public/seed_GIFs/Glute-Kick-Back-Right-.gif',
                'calories' => 150,
            ],

                // H

            [
                'name' => 'Heel Touch ',
                'description' => 'Lie on the ground with your legs bent and your arms by your sides.
                Slightly lift your upper body off the floor and make your hands alternately reach your heels.',
                'gif' => 'public/seed_GIFs/Heel-Touch-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Hindu Push up ',
                'description' => 'Start with your hands and feet touching the floor, body bent and butt up in an upside down V shape.

                Then bend your elbows to bring your body towards the floor.

                When your body is close to the floor, raise your upper body up as far as possible. Then return to the original position and repeat.',
                'gif' => 'public/seed_GIFs/Hindu-Push-up-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Hip Hinge ',
                'description' => 'Stand upright with your feet shoulder-width apart.

                Sit your hips back and bend your upper body while keeping your upper body straight, then slowly go back to the start position and repeat the exercise.

                Inhale as you bend down, and exhale as you come up.',
                'gif' => 'public/seed_GIFs/Hip-Hinge-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Hover Push up ',
                'description' => 'Start in a push-up position. Lower yourself; shift your body to the left and then to the right.

                Push your body up and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Hover-Push-up-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Hyperextension ',
                'description' => 'Lie down on your stomach with your toes touching the floor, and your chin on your hand.

                Raise your chest up as high as possible off the floor. Hold this position for a few seconds and then go back to the start position.

                Repeat this exercise.',
                'gif' => 'public/seed_GIFs/Hyperextension-.gif',
                'calories' => 150,
            ],

                // I

            [
                'name' => 'Inchworms ',
                'description' => 'Start with your feet shoulder width apart.
                Bend your body and walk your hands in front of
                you as far as you can, then walk your hands back.
                Repeat the exercise',
                'gif' => 'public/seed_GIFs/Inchworms-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Incline Push-Ups ',
                'description' => 'Start in the regular push-up position but with your hands elevated on a chair or bench.
                Then push your body up down using your arm strength.
                Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Incline-Push-Ups-.gif',
                'calories' => 150,
            ],

                // J

            [
                'name' => 'Jumping Jacks ',
                'description' => 'Start with your feet together and your arms by your sides, then jump up with your feet apart and your hands overhead.

                Return to the start position then do the next rep. This exercise provides a full-body workout and works all your large muscle groups.',
                'gif' => 'public/seed_GIFs/Jumping-Jacks-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Jumping Squrts ',
                'description' => 'Start in the squat position, then jump up using your abdominal muscles for strength. This exercise works your abdomen.',
                'gif' => 'public/seed_GIFs/Jumping-Squrts-.gif',
                'calories' => 150,
            ],

                // K

            [
                'name' => 'Knee Push Ups ',
                'description' => 'Start in the regular push-up position, then let your knees touch the floor and raise your feet up off the floor.
                Next push your body up and down.',
                'gif' => 'public/seed_GIFs/Knee-Push-Ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Knee To Chest Stretch Left ',
                'description' => 'Lie on the floor with your legs extended. Lift your left knee up and grab it with both hands.

                Pull your left knee towards your chest as much as you can while keeping your right leg straight on the ground.

                Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Knee-To-Chest-Stretch-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Knee To Chest Stretch Right ',
                'description' => 'Lie on the floor with your legs extended. Lift your right knee up and grab it with both hands.

                Pull your right knee towards your chest as much as you can while keeping your left leg straight on the ground.

                Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Knee-To-Chest-Stretch-Right-.gif',
                'calories' => 150,
            ],

                // L

            [
                'name' => 'Leaning Stretcher Raises ',
                'description' => 'Stand a big step away from the wall, put your hands on the wall and lean on it.

                Lift your heels as high as you can and then lower them down. Repeat the exercise.2',
                'gif' => 'public/seed_GIFs/Leaning-Stretcher-Raises-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Left Quad Stretch With Wall ',
                'description' => 'Stand with your right hand on the wall. Bend your left leg and grasp your ankle or toes to bring your left calf close to your left thigh. Hold this position.',
                'gif' => 'public/seed_GIFs/Left-Quad-Stretch-With-Wall-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Leg Barbell Curl Left ',
                'description' => 'Stand against a wall. Lift your right leg up, lean forward and grab underneath your right ankle with your left hand.

                Bring the ankle up towards the shoulder as much as you can, then lower it and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Leg-Barbell-Curl-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Leg Barbell Curl Right ',
                'description' => 'Stand against a wall. Lift your left leg up, lean
                forward and grab underneath your left ankle with
                your right hand.
                Bring the ankle up towards the shoulder as much
                as you can, then lower it and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Leg-Barbell-Curl-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Leg Raises ',
                'description' => 'Lie down on your back, and put your hands beneath your hips for support.
                Then lift your legs up until they form a right angle with the floor.
                Slowly bring your legs back down and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Leg-Raises-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Lunges ',
                'description' => 'Stand with your feet shoulder width apart and your hands on your hips.

                Take a step forward with your right leg and lower your body until your right thigh is parallel with the floor.

                Then return and switch to the other leg. This exercise strengthens the quadriceps, gluteus maximus and hamstrings.',
                'gif' => 'public/seed_GIFs/Lunges-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Lying Butterfly Stretch ',
                'description' => 'Lie on the floor with your feet together. Open your knees to the sides. Hold this position.

                Breathe in deeply and slowly breathe out.',
                'gif' => 'public/seed_GIFs/Lying-Butterfly-Stretch-.gif',
                'calories' => 150,
            ],

                // M

            [
                'name' => 'Military Push Ups ',
                'description' => 'Start in a push-up position with your hands directly under your shoulders and feet no more than 12 inches apart.

                Bend your elbows and lower your body until your upper arms are parallel to the floor. Stay in this position for one second and then push your body back to the starting position and repeat the exercise. Please remember that your elbows should be close to your body during this exercise.',
                'gif' => 'public/seed_GIFs/Military-Push-Ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Modified Push up Low Hold ',
                'description' => 'Start in the standard push-up position but with your feet shoulder-width apart and knees on the ground.

                Lower your body until your elbows are at 90 degrees. Hold this position.',
                'gif' => 'public/seed_GIFs/Modified-Push_up-Low-Hold-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Mountain Climber ',
                'description' => 'Start in the push-up position. Bend your right knee towards your chest and keep your left leg straight, then quickly switch from one leg to the other.
                This exercise strengthens multiple muscle groups.',
                'gif' => 'public/seed_GIFs/Mountain-Climber-.gif',
                'calories' => 150,
            ],

                // P

            [
                'name' => 'Pick Push-up ',
                'description' => 'Start with your hands and feet on the floor. Put your hands shoulder width apart. Bend your body, and lift your hips up in an upside down V shape.

                Bend your elbows, and bring your head close to the floor. Push your body back, and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Pick-Push-up-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Prone Triceps Push-Ups ',
                'description' => 'Lie on your stomach with your hands underneath your shoulders and your elbows bent.

                Slightly raise your chest up, and then go back to the start position.

                Repeat this exercise.',
                'gif' => 'public/seed_GIFs/Prone-Triceps-Push-Ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Plank ',
                'description' => 'Lie on the floor with your toes and forearms on the ground. Keep your body straight and hold this position as long as you can.
                Do not hold your breath. Breathe normally from your abdomen instead of your chest.
                This exercise strengthens the abdomen, back and shoulders.',
                'gif' => 'public/seed_GIFs/Plank-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Punches ',
                'description' => 'Stand with one of your legs forward and your
                knees bent slightly. Bend your elbows and clench
                your fists in front of your face.

                Extend one arm forward with the palm facing the
                floor. Take the arm back and repeat with the other arm.',
                'gif' => 'public/seed_GIFs/Punches-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Push-up and Rotation ',
                'description' => 'Start in the push-up position. Then go down for a push-up and as you come up, rotate your upper body and extend your right arm upwards.

                Repeat the exercise with the other arm. It is a great exercise for the chest, shoulders, arms and core.',
                'gif' => 'public/seed_GIFs/Push-up-and-Rotation-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Push-Ups ',
                'description' => 'Lay prone on the ground with arms supporting your body.
                Keep your body straight while raising and lowering your body with your arms.
                This exercise works the chest, shoulders, triceps, back and legs.',
                'gif' => 'public/seed_GIFs/Push-Ups-.gif',
                'calories' => 150,
            ],

                // R

            [
                'name' => 'Reclined Rhomboid Squeezes ',
                'description' => 'Sit with your knees bent. Slightly lean your upper body back.

                Stretch your arms in front of you, then pull your elbows back to make your elbows at a 90 degree angle and squeeze your shoulder blades.

                Repeat this exercise.',
                'gif' => 'public/seed_GIFs/Reclined-Rhomboid-Squeezes-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Reverse Flutter Kicks ',
                'description' => 'Lie face down on a bench, place your butt on the edge of the bench and hold on to the sides.

                Then lift your legs until they are level with your upper body.

                Lift one leg higher than the other, then switch to the other leg and repeat.',
                'gif' => 'public/seed_GIFs/Reverse-Flutter-Kicks-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Reverse Push-up ',
                'description' => 'Start in the regular push-up position.

                Lower your body down, then bend your knees and move your hips backward with your arms straight.

                Go back to the push-up position and repeat.',
                'gif' => 'public/seed_GIFs/Reverse-Push-up-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Reverse Snow Angles ',
                'description' => 'Lie on your stomach with your arms at your sides.

                Lift your arms up and extend them over your head to touch your thumbs. Then slowly bring them back.

                Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Reverse-Snow-Angles-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Rhomboid Pulls ',
                'description' => 'Stand with your feet shoulder width apart.

                Raise your arms parallel to the ground, and bend your elbows. Pull your elbows back and squeeze your shoulder blades.

                Repeat this exercise.',
                'gif' => 'public/seed_GIFs/Rhomboid-Pulls-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Right Quad Stretch With Wall ',
                'description' => 'Stand with your left hand on the wall. Bend your right leg and grasp your ankle or toes to bring your right calf close to your right thigh. Hold this position.',
                'gif' => 'public/seed_GIFs/Right-Quad-Stretch-With-Wall-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Russian Twist ',
                'description' => 'Sit on the floor with your knees bent, feet lifted a little bit and back tilted backwards.
                Then hold your hands together and twist from side to side.',
                'gif' => 'public/seed_GIFs/Russian-Twist-.gif',
                'calories' => 150,
            ],

                // S

            [
                'name' => 'Shoulder Gators ',
                'description' => 'Stand upright with your hands beside your ears and elbows facing each side. Rotate your elbows until both of them are facing the front.',
                'gif' => 'public/seed_GIFs/Shoulder-Gators-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Shoulder Stretch ',
                'description' => 'Place one arm across your body, parallel to the ground, then use the other arm to pull the parallel arm toward your chest.

                Hold for a while, switch arms and repeat the exercise. Keep the inside arm straight during the exercise.',
                'gif' => 'public/seed_GIFs/Shoulder-Stretch-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Arm Raises ',
                'description' => 'Stand with your feet shoulder width apart.
                Raise your arms to the sides at shoulder height, then put them down.
                Repeat the exercise. Keep your arms straight during the exercise.',
                'gif' => 'public/seed_GIFs/Side-Arm-Raises-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Brides Left ',
                'description' => 'Lie on your right side. Put your right elbow directly under your shoulders and put your left hand on your waist. Place your left leg on your right leg.

                Raise your hips upward, hold for 2-4 seconds, then go back to the start position.

                Repeat this exercise.',
                'gif' => 'public/seed_GIFs/Side-Brides-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Brides Right ',
                'description' => 'Lie on your left side. Put your left elbow directly under your shoulders and put your right hand on your waist. Place your right leg on your left leg.

                Raise your hips upward, hold for 2-4 seconds, then go back to the start position.

                Repeat this exercise.',
                'gif' => 'public/seed_GIFs/Side-Brides-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Hop ',
                'description' => 'Stand on the floor, put your hands in front of you and hop from side to side.',
                'gif' => 'public/seed_GIFs/Side-Hop-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Leg Circles Left ',
                'description' => 'Lie on your right side with your head resting on your right hand.

                Then lift your left leg and rotate your foot in circles.',
                'gif' => 'public/seed_GIFs/Side-Leg-Circles-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Leg Circles Right ',
                'description' => 'Lie on your left side with your head resting on your left hand.

                Then lift your right leg and rotate your foot in circles.',
                'gif' => 'public/seed_GIFs/Side-Leg-Circles-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side lying Floor Stretch Left ',
                'description' => 'Lie on your right side with your right knee slightly bent in front of you and your left leg stretched behind the right leg.

                Straighten your left arm over your head and gently pull on your left wrist to stretch the left side of your body.

                Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Side-lying-Floor-Stretch-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Lying Floor Stretch Right ',
                'description' => 'Lie on your left side with your left knee slightly bent in front of you and your right leg stretched behind the left leg.

                Straighten your right arm over your head and gently pull on your right wrist to stretch the right side of your body.

                Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Side-Lying-Floor-Stretch-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Lying Leg Lift Left ',
                'description' => 'Lie down on your side with your head rested on your right arm. Lift your upper leg up and return to the start position.

                Make sure your left leg goes straight up and down during the exercise.

                It is a great exercise for the gluteus.',
                'gif' => 'public/seed_GIFs/Side-Lying-Leg-Lift-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Lying Leg Lift Right ',
                'description' => 'Lie down on your side with your head rested on your left arm. Lift your upper leg up and return to the start position.

                Make sure your right leg goes straight up and down during the exercise. It is a great exercise for the gluteus.',
                'gif' => 'public/seed_GIFs/Side-Lying-Leg-Lift-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Plank Left ',
                'description' => 'Lie on your left side with your forearm supporting your body. Hold your body in a straight line.

                This exercise targets the abdominal muscles and obliques.',
                'gif' => 'public/seed_GIFs/Side-Plank-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Side Plank Right ',
                'description' => 'Lie on your right side with your forearm supporting your body. Hold your body in a straight line.

                This exercise targets the abdominal muscles and obliques.',
                'gif' => 'public/seed_GIFs/Side-Plank-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Single Leg Calf Hop Left ',
                'description' => 'Stand straight with your right leg lifted. Then hop up and down on your left foot.',
                'gif' => 'public/seed_GIFs/Single-Leg-Calf-Hop-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Single Leg Calf Hop Right ',
                'description' => 'Stand straight with your left leg lifted. Then hop up and down on your right foot.',
                'gif' => 'public/seed_GIFs/Single-Leg-Calf-Hop-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Sit Ups ',
                'description' => 'Lie on your back with your hands behind your ears.

                Then lift your upper body off the floor and slowly up to the sitting position. Do not tug your neck when you get up.

                Slowly go back to the start position and repeat the exercise.

                If your spine hurts, please change to another workout.',
                'gif' => 'public/seed_GIFs/Sit-Ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Skipping Without Rope ',
                'description' => 'Place your arms at your sides and pretend to hold a skipping rope handle in each hand.

                Jump and alternately land on the balls of your feet, rotating your wrists at the same time as if you were spinning a rope.',
                'gif' => 'public/seed_GIFs/Skipping-Without-Rope-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Spiderman Push Up ',
                'description' => 'Start in the regular push-up position. When lowering your torso downward, bend and lift one leg to the side.

                Then return to the start position and switch to the other leg.

                Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Spiderman-Push-Up-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Spine Lumber Twist Strech Left ',
                'description' => 'Lie on your back with your legs extended.
                Exhale, lift your left leg up and use your right hand to pull your left knee to the right. Keep your other arm extended to the side on the floor.
                Breathe naturally. Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Spine-Lumber-Twist-Strech-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Spine Lumber Twist Strech Right ',
                'description' => 'Lie on your back with your legs extended.
                Exhale, lift your right leg up and use your left hand to pull your right knee to the left. Keep your other arm extended to the side on the floor.
                Breathe naturally. Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Spine-Lumber-Twist-Strech-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Squats ',
                'description' => 'Stand with your feet shoulder width apart and your arms stretched forward, then lower your body until your thighs are parallel with the floor.

                Your knees should be extended in the same direction as your toes. Return to the start position and do the next rep.

                This works the thighs, hips buttocks, quads, hamstrings and lower body.',
                'gif' => 'public/seed_GIFs/Squats-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Staggered Push ups ',
                'description' => 'Start in the regular push-up position, but with one hand in front of the other.

                Then do a push-up and switch the other hand in front.

                Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Staggered-Push-ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Standing Biceps Stretch Left ',
                'description' => 'Stand with your left arm close to a wall. Extend your left arm and put your left hand on the wall, then gently turn your body to the right.',
                'gif' => 'public/seed_GIFs/Standing-Biceps-Stretch-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Standing Biceps Stretch Right ',
                'description' => 'Stand with your right arm close to a wall. Extend your right arm and put your right hand on the wall, then gently turn your body to the left.',
                'gif' => 'public/seed_GIFs/Standing-Biceps-Stretch-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Sumo Squat ',
                'description' => 'Stand with your feet 6-12 inches apart. Stretch your arms in front of you.

                Lower your body until your thighs are parallel to the floor. Return to the starting position and repeat the exercise.',
                'gif' => 'public/seed_GIFs/Sumo-Squat-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Sumo Squat Calf Raises With Wall ',
                'description' => 'Stand with your hands on the wall and your feet a little wider than shoulder width apart.

                Lower your body until your thighs are parallel to the floor. Lift your heels up and down.',
                'gif' => 'public/seed_GIFs/Sumo-Squat-Calf-Raises-With-Wall-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Supine Push-up ',
                'description' => 'Lie on your back with your feet flat on the floor and your arms bent on two sides.

                Push your chest up as far as you can, and then slowly go back to the start position.

                Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Supine-Push-up-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Swimming and Superman ',
                'description' => 'Lie on your stomach with your arms extended straight overhead. Alternately lift your opposite arm and leg.',
                'gif' => 'public/seed_GIFs/Swimming-and-Superman-.gif',
                'calories' => 150,
            ],

                // T

            [
                'name' => 'Triceps Dips ',
                'description' => 'For the start position, sit on the chair. Then move your hip off the chair with your hands holding the edge of the chair.
                Slowly bend and stretch your arms to make your body go up and down. This is a great exercise for the triceps.',
                'gif' => 'public/seed_GIFs/Triceps-Dips-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Triceps Kick Backs ',
                'description' => 'Lean forward, bend your knees and your elbows.

                Extend your arms behind you and squeeze your triceps. Please make your arms parallel to the ground when extending them.

                Go back to the start position, and repeat this exercise.',
                'gif' => 'public/seed_GIFs/Triceps-Kick-Backs-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Triceps Stretch Left ',
                'description' => 'Put your left hand on your back, use your right
                hand to grab your left elbow and gently pull it.
                Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Triceps-Stretch-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Triceps Stretch Right ',
                'description' => 'Put your right hand on your back, use your left hand to grab your right elbow and gently pull it. Hold this position for a few seconds.',
                'gif' => 'public/seed_GIFs/Triceps-Stretch-Right-.gif',
                'calories' => 150,
            ],

                // V

            [
                'name' => 'V-up ',
                'description' => 'Lie on your back with your arms and legs extended and your legs squeezed together.

                Raise your upper body and legs, use your arms to touch your toes, then go back to the start position and repeat the exercise.',
                'gif' => 'public/seed_GIFs/V-up-.gif',
                'calories' => 150,
            ],

                // W

            [
                'name' => 'Wall Calf Raises ',
                'description' => 'Stand straight with your hands on the wall and feet shoulder width apart.

                Lift your heels and stand on your toes. Then drop your heels down. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Wall-Calf-Raises-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Wall Push-Ups ',
                'description' => 'Stand in front of a wall one big step away from it. Then put your hands out straight towards the wall and lean against it. Lift your heels. Slowly bend your elbows and press your upper body towards the wall. Push back and repeat the exercise. Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Wall-Push-Ups-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Wall Resisting Single Leg Calf Raise Left ',
                'description' => 'Stand a big step away from the wall. Put your right foot on your left ankle. Put your hands on the wall and lean on it.

                Lift your left heel as high as you can and then lower it. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Wall-Resisting-Single-Leg-Calf-Raise-Left-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Wall Resisting Single Leg Calf Raise Right ',
                'description' => 'Stand a big step away from the wall. Put your left foot on your right ankle. Put your hands on the wall and lean on it.

                Lift your right heel as high as you can and then lower it. Repeat the exercise.',
                'gif' => 'public/seed_GIFs/Wall-Resisting-Single-Leg-Calf-Raise-Right-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Wall Sit ',
                'description' => 'Start with your back against the wall, then slide down until your knees are at a 90 degree angle.

                Keep your back against the wall with your hands and arms away from your legs. Hold the position.

                The exercise is to strengthen the quadriceps muscles.',
                'gif' => 'public/seed_GIFs/Wall-Sit-.gif',
                'calories' => 150,
            ],
            [
                'name' => 'Wide Arm Push-ups ',
                'description' => 'Start in the regular push-up position but with your hands spread wider than your shoulders.
                Then push your body up and down. Remember to keep your body straight.',
                'gif' => 'public/seed_GIFs/Wide-Arm-Push-ups-.gif',
                'calories' => 150,
            ],


        ];

        // Loop through the array and create Exercise records
        foreach ($exercises as $exerciseData) {
            Exercise::create($exerciseData);
        }

    }
}
