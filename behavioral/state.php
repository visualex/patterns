<?php

// basic problem in a state machine are the multiple conditions based on which we want the machine to operate.
// imagine a video game where a player can jump & a typical bug is that you can duck while in mid-air. 
// this brief example shows how we can avoid jumping & ducking while "we are in" a JumpingState

class Player
{

   public $standingState;
   public $walkingState;
   public $jumpingState;
   public $runningState;
   public $state;

   public function __construct($status)
   {
      $this->standingState = new RunningState($this); // inittialize the states
      $this->jumpingState = new JumpingState($this);
      $this->runningState = new DuckingState($this);
      $this->state = $this->standingState; // initial state
   }

   public function run()
   {
      return $this->state->run();
   }

   public function jump()
   {
      return $this->state->jump();
   }

   public function duck()
   {
      return $this->state->duck();
   }

   public function setState(State $state)
   {
      $this->state = $state;
      return (string) $this->state;
   }

   public function getRunningState()
   {
      return $this->runningState;
   }

}

// all states will implement these methods
interface State
{
   public function run();
   public function jump();
   public function duck();
}


class JumpingState implements State
{
   public function __construct(Player $player)
   {
      $this->player = $player;
   }

   public function run()
   {
      return $this->player->setState( $this->player->getRunningState() ); //
   }

   public function jump()
   {
      return false; // cant jump in a jumping state
   }

   public function duck()
   {
      return false; // ducking is weird while jumping
   }

}

// rest of the states



