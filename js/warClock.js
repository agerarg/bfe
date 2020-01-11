
		delay=(ms)=>{
			var ctr, rej, p = new Promise(function (resolve, reject){
				ctr = setTimeout(resolve,ms);
				rej = reject;
			});
			p.cancel = function(){ clearTimeout(ctr); rej(Error("Cancelled"))};
			return p;
		}

	class clock {
		constructor(id,time,endMsg){
			this.reloj = document.getElementById(id);
			this.totalTime = time;
			this.setTimers();
      this.print();
      this.reloj.hidden = false;
      if(this.totalTime>0)
        this.reloj.style.display = 'block';
      this.endMsg=endMsg;
		}
		
		print()
		{
			this.setTimers();
			let min = this.minutos-parseInt(this.horas*60);
			let seg = this.segundos-parseInt(this.minutos*60);
			let hour = this.horas;
			this.reloj.innerHTML = (hour<10?"0":"")+hour+" - "+(min<10?"0":"")+min+" - "+(seg<10?"0":"")+seg;
      this.totalTime--;
      if(this.totalTime<=0)
        this.reloj.innerHTML = this.endMsg;
			delay(1000).then( ()=>{if(this.totalTime>0) this.print(); });
		}
		setTimers()
		{
			this.minutos = parseInt(this.totalTime/60);
			this.horas = parseInt(this.minutos/60);
			this.segundos = this.totalTime;
		}
	}
