#Ajout des librairies du jeu
require 'rubygems'
require 'gosu'
require './player.rb'
# instanciation des éléemnts du jeu
class MyWindow < Gosu::Window
  def initialize
    super 640, 480, false #width , height, fullscreen
    self.caption = 'ManaSword - La quête de l\'epee perdu'
    @background_image = Gosu::Image.new(self, "images/background.jpg")
    @player = Player.new(550, 400, self) #instanciation du joueur avec la taille de la sprite
    @monstre = Monstre.new(550, 400, self)
    @message = Gosu::Image.from_text(self, 'Hello World', Gosu.default_font_name, 30)
  end

  def update # mettre à jour les données du jeu (déplacer joueur, collision)
    @player.move_left if button_down?(Gosu::Button::KbLeft)
    @player.move_right if button_down?(Gosu::Button::KbRight)
    @player.move_up if button_down?(Gosu::Button::KbUp)
    @player.move_down if button_down?(Gosu::Button::KbDown)
    @player.escape if button_down?(Gosu::Button::KbEscape)
  end

  def draw #affiche les éléments du jeu
    @background_image.draw(0,0,0)
    @player.draw
    @monstre.draw
    @message.draw(50, 50, 0)
  end
end




  class Monstre
    def initialize(x, y, window)
      @x, @y = x, y
      @image = Gosu::Image.new(window, "images/mob.png")
    end
      def draw
        @image.draw(10, 8, 1)
      end
    end

window = MyWindow.new
window.show
