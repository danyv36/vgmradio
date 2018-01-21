ALTER TABLE vgm.likes
ADD CONSTRAINT FK_IdSong
FOREIGN KEY (idsong) REFERENCES songs(idsong);

select s.idsongs, l.likes
from vgm.songs s
LEFT JOIN vgm.likes l
ON s.idsongs = l.idsong
LEFT JOIN vgm.users u
ON u.id = l.iduser
where u.id = 3
;

select s.*, l.likes
from vgm.songs s
LEFT JOIN vgm.likes l
ON s.idsongs = l.idsong
LEFT JOIN vgm.users u
ON u.id = l.iduser
and u.id = 3
order by idsongs asc
;

select * 
from vgm.playlists
where iduser = 3;

-- CALL getUserLikes(0);